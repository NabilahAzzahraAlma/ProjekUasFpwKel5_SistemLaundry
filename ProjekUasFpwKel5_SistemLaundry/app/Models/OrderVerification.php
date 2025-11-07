<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderVerification extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'verified_by', 'verified_at', 'notes'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
