<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['Sony', 'sony-logo.png', 'Thương hiệu âm thanh và công nghệ hàng đầu đến từ Nhật Bản.'],
            ['Logitech', 'logitech-logo.png', 'Chuyên về phụ kiện máy tính: chuột, bàn phím, tai nghe,...'],
            ['Razer', 'razer-logo.png', 'Thương hiệu gaming nổi tiếng với thiết kế độc đáo.'],
            ['Anker', 'anker-logo.png', 'Pin sạc, cáp sạc, sạc nhanh chất lượng cao.'],
            ['Ugreen', 'ugreen-logo.png', 'Thiết bị chuyển đổi, cáp, hub USB, dock đa năng.'],
        ];

        foreach ($brands as [$name, $logo, $desc]) {
            Brand::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'logo' => $logo,
                'description' => $desc,
            ]);
        }
    }
}
