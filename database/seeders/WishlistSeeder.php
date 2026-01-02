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

        Wishlist::insert([
            [
                'user_id' => $user->id,
                'item_name' => 'Headset Wireless',
                'price' => 350000,
                'status' => 'pending',
                'priority' => 1,
            ],
            [
                'user_id' => $user->id,
                'item_name' => 'Keycaps Mechanical',
                'price' => 200000,
                'status' => 'on_going',
                'priority' => 2,
            ],
            [
                'user_id' => $user->id,
                'item_name' => 'Cooling Pad Laptop',
                'price' => 150000,
                'status' => 'done',
                'priority' => 3,
            ],
        ]);
    }
}
