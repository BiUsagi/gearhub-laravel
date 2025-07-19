<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;
use Carbon\Carbon;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $discounts = [
            [
                'title' => 'Giảm sốc tháng 7',
                'description' => 'Ưu đãi đặc biệt trong tháng 7 cho toàn bộ danh mục.',
                'discount_amount' => null,
                'discount_percent' => 15.00,
                'start_date' => $now->copy()->subDays(5),
                'end_date' => $now->copy()->addDays(25),
                'is_active' => true,
            ],
            [
                'title' => 'Back to School',
                'description' => 'Giảm ngay 100K cho các sản phẩm học tập và văn phòng.',
                'discount_amount' => 100000,
                'discount_percent' => null,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(14),
                'is_active' => true,
            ],
            [
                'title' => 'Flash Sale Cuối Tuần',
                'description' => 'Chỉ áp dụng vào thứ 7 và Chủ nhật hằng tuần.',
                'discount_amount' => null,
                'discount_percent' => 10.00,
                'start_date' => $now->copy()->next(Carbon::SATURDAY),
                'end_date' => $now->copy()->next(Carbon::SUNDAY)->endOfDay(),
                'is_active' => true,
            ],
            [
                'title' => 'Tặng thêm 50K khi mua combo',
                'description' => 'Áp dụng khi mua từ 3 sản phẩm trở lên.',
                'discount_amount' => 50000,
                'discount_percent' => null,
                'start_date' => $now->copy()->subDays(2),
                'end_date' => $now->copy()->addDays(10),
                'is_active' => true,
            ],
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}
