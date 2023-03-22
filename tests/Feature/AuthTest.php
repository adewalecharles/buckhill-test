<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_admin_can_login(): void
    {
        $response = $this->post('/api/v1/admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                "token",
                "type",
                "expires",
                "user" => []
            ],
        ]);
    }

    public function test_admin_can_register():void
    {
        $response = $this->post('/api/v1/admin/create', [
            'first_name' => 'adewale',
            'last_name' => 'adewale',
            'email' => fake()->email(),
            'password' => 'admin',
            'password_confirmation' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'is_marketing' => 0,
            'is_admin' => true,
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address()
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                "token",
                "type",
                "expires",
                "user" => []
            ],
        ]);
    }

    public function test_admin_can_logout():void
    {
        $login = $this->post('/api/v1/admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
        ]);
        $response = $this->get('/api/v1/admin/logout',[
            "Authorization" => "Bearer ". $login->json()['data']['token']
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [],
        ]);
    }
}
