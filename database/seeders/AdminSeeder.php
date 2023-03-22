<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'is_marketing' => 0,
            'is_admin' => true,
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address()
        ]);
    }
}
