<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_admin_can_view_all_users(): void
    {
        $login = $this->post('/api/v1/admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
        ]);
        $response = $this->get('/api/v1/admin/user-listing', [
            'Authorization' => 'Bearer '.$login->json()['data']['token'],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [
                'data' => [

                ],
            ],
        ]);
    }

    public function test_admin_can_edit_user(): void
    {
        $user = User::where('is_admin', false)->where('id', rand(1, 10))->first();

        $login = $this->post('/api/v1/admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
        ]);

        $response = $this->put('/api/v1/admin/user-edit/'.$user->uuid,
            [
                'first_name' => 'adewale',
                'last_name' => 'adewale',
                'is_marketing' => rand(0, 1),
                'is_admin' => true,
                'phone_number' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ],
            [
                'Authorization' => 'Bearer '.$login->json()['data']['token'],
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [],
        ]);
    }

    public function test_admin_can_delete_user(): void
    {
        $user = User::where('is_admin', false)->where('id', rand(1, 10))->first();

        $login = $this->post('/api/v1/admin/login', [
            'email' => 'admin@buckhill.co.uk',
            'password' => 'admin',
        ]);
        $response = $this->delete('/api/v1/admin/user-delete/'.$user->uuid, [], [
            'Authorization' => 'Bearer '.$login->json()['data']['token'],
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [],
        ]);
    }
}
