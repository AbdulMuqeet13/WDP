<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreditLevelIncome extends Command
{
    protected $signature = 'level:income';
    protected $description = 'Distribute level income to uplines (up to 15 levels) based on team ROI or investments.';

    /**
     * @throws \Throwable
     */
    public function handle(): int
    {
        $today = Carbon::now();

        // Skip weekends if needed
        if ($today->isSaturday() || $today->isSunday()) {
            $this->info("Weekend: Skipping level income distribution.");
            return CommandAlias::SUCCESS;
        }

        $levelRates = config('referrals');

        DB::beginTransaction();

        try {
            $users = User::with('wallet', 'referrer')->active()->get();

            foreach ($users as $user) {
                // Skip users without ROI today
                $roiToday = $user->transactions()
                    ->whereJsonContains('meta->type', 'ROI Credit')
                    ->whereDate('created_at', $today->toDateString())
                    ->sumAmountFloat('amount');

                if ($roiToday <= 0) continue;

                // Traverse up to 15 levels
                $this->distributeLevelIncome($user, $roiToday, $levelRates, $today);
            }

            DB::commit();
            $this->info("✅ Level income distributed successfully.");

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error("❌ Error: " . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }

        return CommandAlias::SUCCESS;
    }

    protected function distributeLevelIncome(User $user, float $roiAmount, array $levelRates, Carbon $today): void
    {
        if ($user->balanceFloat < 50) {
            return;
        }
        $referrer = $user->referrer;
        $level = 1;

        while ($referrer && $level <= 15) {
            $rate = $levelRates[$level] ?? 0;

            if ($rate > 0 && $referrer->wallet) {
                $bonus = $roiAmount * $rate;

                $referrer->depositFloat($bonus, [
                    'type' => 'Level Income',
                    'referrer_id' => $referrer->id,
                    'description' => "Level {$level} income from {$user->name}'s ROI on {$today->toDateString()}",
                ]);

                $this->info("Level {$level} income of {$bonus} credited to {$referrer->name}");
            }

            $referrer = $referrer->referrer;
            $level++;
        }
    }
}
