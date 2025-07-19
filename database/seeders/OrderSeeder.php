<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $districts = ['Thanh Khê', 'Hải Châu', 'Ngũ Hành Sơn', 'Sơn Trà'];
        $cities = ['Đà Nẵng', 'Hà Nội', 'TP. Hồ Chí Minh'];
        $wards = ['Hòa Thuận Đông', 'Hòa Cường Bắc', 'An Hải Tây', 'Mỹ An'];

        foreach ($users as $user) {
            $orderCode = 'ORD' . now()->format('Ymd') . strtoupper(Str::random(3));

            $recipientName = $user->name;
            $recipientPhone = $user->phone;
            $addressLine = 'Số ' . rand(10, 99) . ' Đường ' . Str::title(Str::random(6));
            $ward = fake()->optional()->randomElement($wards);
            $district = fake()->randomElement($districts);
            $city = fake()->randomElement($cities);

            // Giả lập sản phẩm và giá
            $products = Product::inRandomOrder()->take(rand(1, 3))->get();
            $subtotal = 0;

            foreach ($products as $product) {
                $price = $product->sale_price ?? $product->price;
                $quantity = rand(1, 2);
                $subtotal += $price * $quantity;
            }

            $shippingFee = rand(0, 1) ? 30000 : 50000;
            $discountAmount = rand(0, 1) ? rand(10000, 50000) : 0;
            $total = $subtotal + $shippingFee - $discountAmount;

            Order::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'recipient_name' => $recipientName,
                'recipient_phone' => $recipientPhone,
                'address_line' => $addressLine,
                'ward' => $ward,
                'district' => $district,
                'city' => $city,
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'discount_amount' => $discountAmount,
                'total' => $total,
                'status' => fake()->randomElement(['pending', 'processing', 'shipping', 'completed']),
                'ordered_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
