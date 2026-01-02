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
            ['email' => 'user@example.com'],
            [
                'name' => 'User Default',
                'password' => Hash::make('12345678'),
            ]
        );

        $this->call([
            ScheduleSeeder::class,
            FinanceSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
