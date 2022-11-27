<?php

namespace Tests\Feature;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_get_jwt_access_token(): void
    {
        $response = $this->postJson(
            '/api/auth/login',
            [
                'email' => 'test.proxy@mailinator.com',
                'password' => 'test'
            ]
        );

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }

    public function test_me_endpoint_for_logged_in_user(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user, 'api')
            ->post('/api/auth/me');

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ]);
    }

    public function test_logout_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->post('/api/auth/logout');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Successfully logged out']);
    }

    public function test_refresh_token(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->post('/api/auth/refresh');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }
}
