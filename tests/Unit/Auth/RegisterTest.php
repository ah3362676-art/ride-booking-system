<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار عرض صفحة التسجيل
     */
    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * اختبار إنشاء مستخدم جديد
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Mohamed',
            'email' => 'mohamed@example.com',
            'phone' => '01012345678',
            'role' => 'rider',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // التأكد من أن المستخدم اتسجل
        $this->assertDatabaseHas('users', [
            'email' => 'mohamed@example.com',
            'phone' => '01012345678',
            'role' => 'rider',
        ]);

        // التأكد من أنه اتحول للداشبورد
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
