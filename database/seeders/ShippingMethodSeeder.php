<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    public function run(): void
    {
        ShippingMethod::insert([
            [
                'name' => 'Giao hàng tiêu chuẩn',
                'fee' => 30000,
                'description' => 'Giao hàng trong 2-4 ngày làm việc.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giao siêu tốc',
                'fee' => 70000,
                'description' => 'Giao trong 24 giờ tại nội thành.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
