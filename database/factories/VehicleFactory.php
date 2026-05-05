<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * البيانات الافتراضية للمركبة
     */
    public function definition(): array
    {
        return [
            // إنشاء سائق افتراضي إن لم يتم تمرير user_id
            'user_id' => User::factory()->driver(),

            // الشركة المصنعة
            'brand' => fake()->randomElement(['Toyota', 'Hyundai', 'Kia', 'Nissan', 'Chevrolet']),

            // الموديل
            'model' => fake()->randomElement(['Corolla', 'Elantra', 'Cerato', 'Sunny', 'Aveo']),

            // اللون
            'color' => fake()->safeColorName(),

            // رقم لوحة فريد
            'plate_number' => strtoupper(fake()->bothify('???-####')),
//دي بتولّد استرنج عشوائي بالشكل ده:
// ? = حرف (A-Z)
// # = رقم (0-9)

            // عدد المقاعد
            'seats_count' => fake()->numberBetween(3, 7),

            // مفعلة افتراضيًا
            'is_active' => true,
        ];
    }

    /**
     * حالة مركبة غير مفعلة
     */
    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}
