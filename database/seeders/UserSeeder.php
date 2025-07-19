<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User chính (bạn)
        User::create([
            'name' => 'Trương Bá Sơn',
            'email' => 'sontr.dev@gmail.com',
            'phone' => '0343561287',
            'avatar' => 'son-sq.png',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'status' => 'active',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login_at' => now(),
            'register_ip' => '127.0.0.1',
        ]);

        // 4 user giả lập
        $faker = Faker::create();

        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'phone' => '09' . $faker->numerify('########'),
                'avatar' => 'default-avatar.png',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'status' => $faker->randomElement(['active', 'inactive']),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'last_login_at' => $faker->optional()->dateTimeThisMonth(),
                'register_ip' => $faker->ipv4(),
            ]);
        }
    }
}
