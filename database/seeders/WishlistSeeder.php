<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wishlist;
use App\Models\User;

class WishlistSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            return;
        }

       Wishlist::insert([
    [
        'user_id' => $user->id,
        'item_name' => 'Headset Wireless',
        'price' => 350000,
        'status' => 'ingin',
        'priority' => 1, // 🔥 ANGKA
    ],
    [
        'user_id' => $user->id,
        'item_name' => 'Keycaps Mechanical',
        'price' => 200000,
        'status' => 'ditunda',
        'priority' => 2,
    ],
    [
        'user_id' => $user->id,
        'item_name' => 'Cooling Pad Laptop',
        'price' => 150000,
        'status' => 'dibeli',
        'priority' => 3,
    ],
]);
    }
}
