<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Pembayaran::create([
            'order_code'      => 'ORD-6912254E4D281',
            'metode'          => 'va',
            'jumlah'          => 40000,
            'status'          => 'processing',
            'virtual_account' => '1234567890123456',
        ]);
    }
}
