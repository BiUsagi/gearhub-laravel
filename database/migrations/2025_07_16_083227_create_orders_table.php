<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_code')->unique(); // mã đơn hàng (ORD20250716XXX)

            // Địa chỉ giao hàng
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('address_line');
            $table->string('ward')->nullable();
            $table->string('district');
            $table->string('city');

            // Tổng đơn hàng
            $table->decimal('subtotal', 12, 2);
            $table->decimal('shipping_fee', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2);

            // Trạng thái
            $table->enum('status', ['pending', 'processing', 'shipping', 'completed', 'canceled'])->default('pending');
            $table->timestamp('ordered_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
