<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreditDailyROI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example: php artisan roi:credit
     */
    protected $signature = 'roi:credit';

    /**
     * The console command description.
     */
    protected $description = 'Credit daily ROI to users (Mon–Fri only)';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle()
    {
        $today = Carbon::now();

        // Skip weekends
        if ($today->isSaturday() || $today->isSunday()) {
            $this->info("No ROI credited today ({$today->format('l')}).");
            return CommandAlias::SUCCESS;
        }

        DB::beginTransaction();

        try {
            $users = User::role(['user'])->with('wallet')->active()->get();

            foreach ($users as $user) {
                $totalBalance = $user->transactions()->whereJsonContains('meta->type', 'User Deposit')->sumAmountFloat('amount');
                // Only credit if user has positive balance
                if ($totalBalance >= 50) {
                    if ($totalBalance < 5000) {
                        $roiRate = 0.01;
                    } elseif ($totalBalance < 10000) {
                        $roiRate = 0.0125;
                    } else {
                        $roiRate = 0.015;
                    }
                    $roi = $totalBalance * $roiRate;

                    $user->depositFloat($roi, [
                        'type' => 'ROI Credit',
                        'description' => "Daily ROI credited on {$today->toDateString()}",
                    ]);

                    $this->info("Credited ROI of {$roi} to {$user->name} ({$user->email})");
                }
            }

            DB::commit();
            $this->info("✅ ROI credited successfully for all users.");

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error("❌ Error: " . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
