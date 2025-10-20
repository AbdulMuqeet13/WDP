<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant admin role to a user';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $user->assignRole('admin');
        $this->info("{$user->email} is now an admin!");
    }
}
