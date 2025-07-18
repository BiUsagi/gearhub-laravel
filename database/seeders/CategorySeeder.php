<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Danh mục cha
        $parentCategories = [
            'Tai nghe',
            'Chuột',
            'Bàn phím',
            'Màn hình',
            'Phụ kiện khác',
        ];

        foreach ($parentCategories as $name) {
            $parent = Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "Danh mục $name chất lượng cao",
                'parent_id' => null,
                'is_active' => 1,
            ]);

            // Tạo danh mục con cho mỗi danh mục cha
            for ($i = 1; $i <= 2; $i++) {
                $subName = $name . ' dòng ' . $i;
                Category::create([
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'description' => "Dòng sản phẩm $subName",
                    'parent_id' => $parent->id,
                    'is_active' => 1,
                ]);
            }
        }
    }
}
