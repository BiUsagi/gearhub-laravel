<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'method', // cod, bank_transfer, momo, vnpay, etc.
        'status', // pending, completed, failed, refunded
        'transaction_id',
        'transaction_data', // JSON data from payment gateway
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_data' => 'json',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Scopes
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeMethod($query, $method)
    {
        return $query->where('method', $method);
    }
}
