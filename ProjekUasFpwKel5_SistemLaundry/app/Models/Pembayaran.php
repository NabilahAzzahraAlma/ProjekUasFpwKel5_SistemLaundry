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

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_code', 'order_code');
    }


    /**
     * Helper untuk menampilkan link QR statis
     */
    public function getQrLinkAttribute()
    {
        return $this->kode_qr
            ?? asset('img/qris_images.png') . $this->order->order_code;
    }
}
