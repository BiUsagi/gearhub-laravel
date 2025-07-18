<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Tai nghe Bluetooth Sony WH-1000XM4', 1, 1, 5990000, 4990000, 50, 1],
            ['Tai nghe Gaming Logitech G733', 1, 2, 2990000, 2490000, 30, 1],
            ['Chuột không dây Logitech M650', 2, 2, 690000, null, 100, 0],
            ['Chuột Gaming Razer DeathAdder V2', 2, 3, 1290000, 990000, 40, 1],
            ['Bàn phím cơ DAREU EK87', 3, 1, 1190000, 990000, 60, 1],
            ['Bàn phím cơ Keychron K2', 3, 3, 1890000, null, 45, 0],
            ['Pin dự phòng Anker 20000mAh', 4, 4, 990000, 790000, 120, 1],
            ['Hub USB-C 6 cổng Ugreen', 4, 4, 590000, null, 75, 0],
            ['Đế tản nhiệt laptop RGB Cooler', 5, 5, 450000, 390000, 80, 1],
            ['Giá đỡ điện thoại hợp kim', 5, 5, 250000, null, 200, 0],
        ];

        foreach ($products as [$name, $categoryId, $brandId, $price, $salePrice, $stock, $isFeatured]) {
            Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'short_description' => "Sản phẩm $name chất lượng cao.",
                'description' => "Mô tả chi tiết của $name với nhiều tính năng nổi bật, phù hợp cho nhu cầu công nghệ hiện đại.",
                'price' => $price,
                'sale_price' => $salePrice,
                'stock' => $stock,
                'is_active' => 1,
                'is_featured' => $isFeatured,
            ]);
        }
    }
}
