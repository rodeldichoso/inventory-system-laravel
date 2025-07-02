<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        Order::create([
            'user_id' => $user->id,
            'receipt_number' => 'ORD-' . Str::upper(Str::random(12)),
            'total' => 900.00,
            'status' => 'completed',
        ]);
    }
}
