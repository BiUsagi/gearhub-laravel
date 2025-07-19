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
            ['Samsung', 'samsung-logo.png', 'Smartphone, Tivi, Thiết bị gia dụng'],
            ['Apple', 'apple-logo.png', 'Laptop, Smartphone, Máy tính bảng'],
            ['Xiaomi', 'xiaomi-logo.png', 'Smartphone, Thiết bị gia dụng thông minh, Thiết bị đeo'],
            ['Dell', 'dell-logo.png', 'Laptop, Màn hình, Máy tính để bàn'],
            ['HP', 'hp-logo.png', 'Máy in, Laptop, Thiết bị văn phòng'],
            ['Asus', 'asus-logo.png', 'Laptop gaming, Linh kiện máy tính, Màn hình'],
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
