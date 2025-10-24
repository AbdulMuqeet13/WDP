<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserReferralSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $previousUser = null;

        for ($i = 1; $i <= 50; $i++) {
            $name = $faker->name();
            $user = User::create([
                'name' => $name,
                'email' => Str::of($name)->lower()->replace(' ', '')->replace(',','') . "@wdigipay.com",
                'password' => Hash::make('password'),
                'referred_by' => $previousUser?->id, // if previousUser exists
            ]);

            // assign default role (using spatie roles)
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('user');
            }

            $previousUser = $user;
        }

        $this->command->info('✅ 50 users created with referral chain successfully!');
    }
}
