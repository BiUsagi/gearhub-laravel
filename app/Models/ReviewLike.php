<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewLike extends Model
{
    use HasFactory;

    protected $table = 'review_likes';

    protected $fillable = [
        'review_id',
        'user_id',
    ];

    // Một lượt thích thuộc về 1 review
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    // Một lượt thích thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
