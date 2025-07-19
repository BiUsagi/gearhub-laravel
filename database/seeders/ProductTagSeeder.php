<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ProductTagSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $tags = Tag::all();

        foreach ($products as $product) {
            // Gán ngẫu nhiên 2–3 tag cho mỗi product
            $randomTags = $tags->random(rand(2, 3))->pluck('id');

            foreach ($randomTags as $tagId) {
                DB::table('product_tag')->insert([
                    'product_id' => $product->id,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
