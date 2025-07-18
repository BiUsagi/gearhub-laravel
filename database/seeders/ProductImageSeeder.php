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
            [1, 'products/aula-f75.webp'],
            [2, 'products/balo-gaming.png'],
            [3, 'products/chuot-khong-day.jpg'],
            [4, 'products/sac-du-phong.webp'],
            [5, 'products/tai-nghe-gaming-pro.png'],
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
