<?php

namespace Database\Factories;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * كلمة المرور الافتراضية
     */
    protected static ?string $password;

    /**
     * تعريف بيانات افتراضية للمستخدم
     */
    public function definition(): array
    {
        return [
            // اسم عشوائي
            'name' => fake()->name(),

            // إيميل فريد
            'email' => fake()->unique()->safeEmail(),

            // رقم هاتف بصيغة بسيطة للتجربة
            'phone' => '01' . fake()->unique()->numerify('#########'),

            // الدور الافتراضي راكب
            'role' => Role::Rider,

            // مفعل
            'is_active' => true,

            // تاريخ تحقق البريد
            'email_verified_at' => now(),

            // كلمة مرور مشفرة
            'password' => static::$password ??= Hash::make('password'),

            // تذكرني
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * حالة أدمن
     */
    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => Role::Admin,
        ]);
    }

    /**
     * حالة سائق
     */
    public function driver(): static
    {
        return $this->state(fn () => [
            'role' => Role::Driver,
        ]);
    }

    /**
     * حالة راكب
     */
    public function rider(): static
    {
        return $this->state(fn () => [
            'role' => Role::Rider,
        ]);
    }

    /**
     * حالة غير مفعّل
     */
    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }

    /**
     * حالة بريد غير موثق
     */
    public function unverified(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }
}
