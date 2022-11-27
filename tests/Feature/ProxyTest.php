<?php

namespace Tests\Feature;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProxyTest extends TestCase
{
    public function test_proxies_list(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->post('/api/proxies/list');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                    '*' => [
                        'ip',
                        'port',
                        'login',
                        'password',
                    ]
                ]
            );
    }

    public function test_proxies_export_no_format(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->post('/api/proxies/export');

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_proxies_export_not_valid_format(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->postJson(
                '/api/proxies/export',
                [
                    'format' => 'port@login',
                ]
            );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_proxies_export_valid_format(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->postJson(
                '/api/proxies/export',
                [
                    'format' => 'ip@login:password',
                ]
            );

        $response->assertStatus(Response::HTTP_OK)
            ->assertHeader('Content-Disposition', 'attachment; filename=proxies.csv')
            ->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }
}
