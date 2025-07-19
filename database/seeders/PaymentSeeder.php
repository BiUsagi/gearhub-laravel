<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
   public function run(): void
    {
        foreach (Order::all() as $order) {
            Payment::create([
                'order_id' => $order->id,
                'method' => 'cod',
                'status' => 'paid',
                'transaction_id' => 'COD-' . strtoupper(uniqid()),
                'paid_at' => now(),
            ]);
        }
    }
}
