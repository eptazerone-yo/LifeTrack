<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🔒 Anti duplicate user
        $user = User::firstOrCreate(
        ['email' => 'userdefault@gmail.com'],
        [
        'name' => 'User Default',
        'password' => Hash::make('12341234'),
        'email_verified_at' => now(),
    ]
);


        $this->call([
            ScheduleSeeder::class,
            FinanceSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
