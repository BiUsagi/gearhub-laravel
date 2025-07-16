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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Thông tin địa chỉ
            $table->string('recipient_name'); // tên người nhận
            $table->string('phone', 15);
            $table->string('address_line'); // địa chỉ cụ thể
            $table->string('ward')->nullable();
            $table->string('district');
            $table->string('city');

            $table->boolean('is_default')->default(false); // địa chỉ mặc định
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
