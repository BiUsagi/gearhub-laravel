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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Thông tin cá nhân
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('avatar')->nullable();

            // Xác thực & đăng nhập
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(); // Có thể null nếu dùng đăng nhập Google
            $table->string('provider')->nullable(); // google, facebook...
            $table->string('provider_id')->nullable(); // ID từ Google/Facebook

            // Trạng thái tài khoản
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active');

            // Bảo mật
            $table->rememberToken();

            // Thời gian
            $table->timestamps();

            // Tính năng phụ
            $table->timestamp('last_login_at')->nullable();
            $table->string('register_ip')->nullable(); // IP đăng ký
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
