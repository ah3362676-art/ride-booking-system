<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار التسجيل عبر API
     */
    public function test_user_can_register_via_api(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'API User',
            'email' => 'apiuser@example.com',
            'phone' => '01099999999',
            'role' => 'rider',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)->assertJsonStructure([
                'message',
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'phone',
                ],
            ]);
    }

    /**
     * اختبار تسجيل الدخول عبر API
     */
    public function test_user_can_login_via_api(): void
    {
        User::factory()->create([
            'email' => 'loginapi@example.com',
            'password' => 'password',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'loginapi@example.com',
            'password' => 'password',
        ]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'message',
                'token',
                'user',
            ]);
    }
}
