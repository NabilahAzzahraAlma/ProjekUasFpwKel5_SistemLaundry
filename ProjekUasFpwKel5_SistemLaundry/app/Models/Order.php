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
}
