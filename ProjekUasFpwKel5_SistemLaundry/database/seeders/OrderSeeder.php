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
            'user_id'        => 1,
            'order_code'     => 'ORD-6912254E4D281',
            'customer_name'  => 'Nabilah Azzahra Alma',
            'product_name'   => 'Cuci Tas - Ocean Breeze',
            'quantity'       => 1,
            'total_price'    => 40000,
            'order_date'     => now()->subDay(),
            'payment_method' => 'Virtual Account',
            'status'         => 'processing',

        ]);
    }
}
