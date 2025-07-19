<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewLike;  

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'images', // JSON array of image URLs
    ];

    protected $casts = [
        'rating' => 'integer',
        'images' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }

    // Scopes
    public function scopeRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }
}
