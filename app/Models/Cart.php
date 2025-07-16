<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id', // cho guest users
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Methods
    public function getSubtotalAttribute()
    {
        return $this->items->sum('subtotal');
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }
}
