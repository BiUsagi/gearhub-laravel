<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;
class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [1, 'products/product-1.png'],
            [2, 'products/product-2.png'],
            [3, 'products/product-3.png'],
            [4, 'products/product-4.png'],
            [5, 'products/product-5.png'],
            [6, 'products/product-4.png'],
            [7, 'products/product-2.png'],
            [8, 'products/product-1.png'],
            [9, 'products/product-2.png'],
            [10, 'products/product-3.png'],
        ];

        foreach ($images as [$productId, $path]) {
            ProductImage::create([
                'product_id' => $productId,
                'image_path' => $path,
                'is_main' => 1,
            ]);
        }
    }
}
