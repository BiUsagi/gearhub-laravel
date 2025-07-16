<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'recipient_name',
        'recipient_phone',
        'address_line',
        'ward',
        'district',
        'city',
        'subtotal',
        'shipping_fee',
        'discount_amount',
        'total',
        'status',
        'ordered_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'ordered_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Scopes
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Methods
    public function getFullAddressAttribute()
    {
        return implode(', ', array_filter([
            $this->address_line,
            $this->ward,
            $this->district,
            $this->city
        ]));
    }

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
    }
}
