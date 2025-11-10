<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'metode',
        'kode_qr',
        'virtual_account',
        'jumlah',
        'status'
    ];

    /**
     * Relasi ke Order
     * - foreign key: order_code (di tabel pembayaran)
     * - owner key: order_code (di tabel order)
     */
    public function pesanan()
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }

    /**
     * Helper untuk menampilkan link QR statis
     */
    public function getQrLinkAttribute()
    {
        return $this->kode_qr
            ?? 'https://via.placeholder.com/200x200.png?text=QR+' . $this->pesanan->order_code;
    }
}
