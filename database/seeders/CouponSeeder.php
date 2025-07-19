<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $coupons = [
            [
                'code' => 'GEAR10',
                'discount_amount' => null,
                'discount_percent' => 10.00,
                'usage_limit' => 100,
                'used_count' => 0,
                'start_date' => $now->copy()->subDays(5),
                'end_date' => $now->copy()->addDays(30),
                'is_active' => true,
            ],
            [
                'code' => 'NEWUSER',
                'discount_amount' => 50000,
                'discount_percent' => null,
                'usage_limit' => 1,
                'used_count' => 0,
                'start_date' => $now,
                'end_date' => $now->copy()->addDays(7),
                'is_active' => true,
            ],
            [
                'code' => 'FREESHIP',
                'discount_amount' => 30000,
                'discount_percent' => null,
                'usage_limit' => 500,
                'used_count' => 25,
                'start_date' => $now->copy()->subDays(10),
                'end_date' => $now->copy()->addDays(20),
                'is_active' => true,
            ],
            [
                'code' => 'SUMMER20',
                'discount_amount' => null,
                'discount_percent' => 20.00,
                'usage_limit' => 200,
                'used_count' => 199,
                'start_date' => $now->copy()->subDays(30),
                'end_date' => $now->copy()->addDays(5),
                'is_active' => true,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
