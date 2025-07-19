<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            ProductTagSeeder::class,
            CouponSeeder::class,
            CouponUserSeeder::class,
            PaymentSeeder::class,
            ShippingMethodSeeder::class,
            OrderSeeder::class,
            DiscountSeeder::class,
            DiscountProductSeeder::class,
            ReviewSeeder::class,
            ReviewLikeSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
