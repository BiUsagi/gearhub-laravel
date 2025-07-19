<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DiscountProductSeeder extends Seeder
{
   public function run(): void
    {
        $discounts = Discount::all();
        $products = Product::all();

        foreach ($discounts as $discount) {
            $randomProducts = $products->random(rand(2, 4));
            foreach ($randomProducts as $product) {
                DB::table('discount_product')->insert([
                    'discount_id' => $discount->id,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
