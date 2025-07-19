<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

class CouponUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $coupons = Coupon::all();

        foreach ($users as $user) {
            $coupon = $coupons->random();
            DB::table('coupon_user')->insert([
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
                'used_at' => now()->subDays(rand(1, 10)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
