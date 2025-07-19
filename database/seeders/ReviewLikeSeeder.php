<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReviewLikeSeeder extends Seeder
{
   
    public function run(): void
    {
        $users = User::all();
        $reviews = Review::all();

        foreach ($reviews as $review) {
            $likedUsers = $users->random(rand(1, 2));
            foreach ($likedUsers as $user) {
                DB::table('review_likes')->insertOrIgnore([
                    'review_id' => $review->id,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
