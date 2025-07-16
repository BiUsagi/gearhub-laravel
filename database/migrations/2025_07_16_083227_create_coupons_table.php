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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // ví dụ: GEAR10, NEWUSER

            $table->decimal('discount_amount', 12, 2)->nullable();
            $table->decimal('discount_percent', 5, 2)->nullable();

            $table->unsignedInteger('usage_limit')->nullable(); // tổng số lần được dùng
            $table->unsignedInteger('used_count')->default(0); // số lần đã dùng

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
