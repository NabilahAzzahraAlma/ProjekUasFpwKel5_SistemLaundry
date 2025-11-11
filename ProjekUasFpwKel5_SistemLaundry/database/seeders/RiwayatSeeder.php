<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Riwayat::create([
            'pesanan_id' => 1,
            'tipe' => 'Pemasukan',
            'jumlah' => 50000,
        ]);

        Riwayat::create([
            'pesanan_id' => 2,
            'tipe' => 'Pemasukan',
            'jumlah' => 30000,
        ]);
    }
}
