<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ActivateUsersWithValidBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:activate-users-with-valid-balance';

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
                $query->whereJsonContains('meta->type', 'User Deposit');
            })
            ->get()
            ->filter(function ($user) {
                $sum = $user->transactions()
                    ->whereJsonContains('meta->type', 'User Deposit')
                    ->sumAmountFloat('amount');

                return $sum >= 10;
            });

        foreach ($users as $user) {
            $user->update(['is_active' => 1]);
        }

    }
}
