<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'customer_name',
        'product_name',
        'quantity',
        'total_price',
        'order_date',
        'status',
        'payment_method'
    ];

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'order_code', 'order_code');
    }

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }

    const STATUS_PENDING = 'Pending';
    const STATUS_DITERIMA = 'Diterima';
    const STATUS_PROSES = 'Proses';
    const STATUS_DICUCI = 'Dicuci';
    const STATUS_DIANTAR = 'Diantar';
    const STATUS_SELESAI = 'Selesai';
    const STATUS_VERIFIED = 'Terverifikasi';
    const STATUS_REJECTED = 'Ditolak';

    

}
