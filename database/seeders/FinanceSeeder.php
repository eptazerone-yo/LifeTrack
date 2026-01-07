<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finance;
use App\Models\User;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Finance::insert([
            [
                'user_id' => $user->id,
                'date' => now()->startOfMonth(),
                'type' => 'income',
                'category' => 'Uang Saku',
                'amount' => 1500000,
                'description' => 'Uang bulanan',
            ],
            [
                'user_id' => $user->id,
                'date' => now()->addDays(3),
                'type' => 'expense',
                'category' => 'Baju',
                'amount' => 150000,
                'description' => 'Kaos Uniqlo',
            ],
            [
                'user_id' => $user->id,
                'date' => now()->addDays(7),
                'type' => 'expense',
                'category' => 'Transport',
                'amount' => 30000,
                'description' => 'Bensin euy',
            ],
        ]);
    }
}
