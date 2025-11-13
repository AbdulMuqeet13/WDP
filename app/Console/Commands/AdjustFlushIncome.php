<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;

class AdjustFlushIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:adjust-flush-income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::query()
            ->whereHas('transactions', function ($query) {
                $query->whereJsonContains('meta->type', 'Level Income')
                ->orWhereJsonContains('meta->type', 'Sponsor Income');
            })
            ->get()
            ->filter(function ($user) {
                $sum = $user->transactions()
                    ->whereJsonContains('meta->type', 'User Deposit')
                    ->sumAmountFloat('amount');

                return $sum < 50;
            })->pluck('id');

        Transaction::whereIn('payable_id', $users)
            ->where(function ($q) {
                $q->whereJsonContains('meta->type', 'Level Income')
                    ->orWhereJsonContains('meta->type', 'Sponsor Income');
            })
            ->update([
                'meta->type' => 'Flush Income',
            ]);
    }
}
