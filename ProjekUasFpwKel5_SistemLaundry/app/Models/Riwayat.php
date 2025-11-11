<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    // use HasFactory;

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'pesanan_id',
        'tipe',     // Pemasukan / Pengeluaran
        'jumlah',
    ];

    // Relasi ke Pesanan
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
// Method untuk menampilkan riwayat di halaman staff
    public function riwayat()
    {
        $riwayats = Riwayat::with('pesanan')->latest()->get();

        return view('staff.riwayat', compact('riwayats'));
    }

    
}
