<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            foreach ($products->random(2) as $product) {
                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'rating' => rand(3, 5),
                    'comment' => 'Sản phẩm rất tốt, chất lượng vượt mong đợi!',
                    'is_approved' => true,
                ]);
            }
        }
    }
}
