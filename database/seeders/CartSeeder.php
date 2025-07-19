<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy 3 user đầu tiên
        $users = User::take(3)->get();
        $products = Product::all();

        foreach ($users as $user) {
            // Tạo giỏ hàng cho user
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);

            // Lấy ngẫu nhiên 2-3 sản phẩm
            $cartProducts = $products->random(rand(2, 3));

            foreach ($cartProducts as $product) {
                $price = $product->sale_price ?? $product->price;

                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                    'price' => $price,
                ]);
            }
        }
    }
}
