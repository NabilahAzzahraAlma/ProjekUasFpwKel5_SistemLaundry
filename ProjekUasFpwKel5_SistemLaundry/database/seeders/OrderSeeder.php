<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        if (Schema::hasTable('order_verifications')) {
             DB::table('order_verifications')->truncate();
        }
        DB::table('orders')->truncate();
        Schema::enableForeignKeyConstraints();

        Order::create([
            'customer_name'   => 'Raffi Naufal Fahreza',
            'category'        => 'Cuci Baju (Kiloan)',
            'perfume_variant' => 'Vanilla',
            'user_id'         => 1,
            'quantity'        => 5, // 5kg
            'total_price'     => 25000,
            'order_date'      => now(),
            'payment_method'  => 'Cash',
            'status'          => 'pending'
        ]);

        Order::create([
            'customer_name'   => 'Nabilah Azzahra Alma',
            'category'        => 'Cuci Sepatu',
            'perfume_variant' => 'Ocean Fresh',
            'user_id'         => 1,
            'quantity'        => 1, // 1 pasang
            'total_price'     => 40000,
            'order_date'      => now()->subDay(),
            'payment_method'  => 'Transfer Bank',
            'status'          => 'processing'
        ]);

        Order::create([
            'customer_name'   => 'Marsya Tri Nadiah',
            'category'        => 'Cuci Boneka',
            'perfume_variant' => 'Sakura',
            'user_id'         => 2,
            'quantity'        => 2, // 2 boneka
            'total_price'     => 30000,
            'order_date'      => now()->subDays(2),
            'payment_method'  => 'E-Wallet',
            'status'          => 'completed'
        ]);
    }
}
