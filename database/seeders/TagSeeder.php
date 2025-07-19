<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Gaming',
            'Không dây',
            'Bluetooth',
            'LED RGB',
            'Compact',
            'Pin lâu',
            'Cắm là chạy',
            'Giá rẻ',
            'Chống ồn',
            'Bền bỉ',
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }
    }
}
