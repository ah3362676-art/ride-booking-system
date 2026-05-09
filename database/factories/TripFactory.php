<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * البيانات الافتراضية للرحلة
     */
    public function definition(): array
    {
        // إنشاء سائق
        $driver = User::factory()->driver()->create();

        // إنشاء مركبة مرتبطة بنفس السائق
        $vehicle = Vehicle::factory()->create([
            'user_id' => $driver->id,
        ]);

        return [
            // السائق
            'driver_id' => $driver->id,

            // المركبة
            'vehicle_id' => $vehicle->id,

            // بيانات البداية
            'start_address' => fake()->streetAddress(),
            'start_lat' => fake()->latitude(29.800000, 31.500000),
            'start_lng' => fake()->longitude(30.900000, 32.000000),

            // بيانات النهاية
            'end_address' => fake()->streetAddress(),
            'end_lat' => fake()->latitude(29.800000, 31.500000),
            'end_lng' => fake()->longitude(30.900000, 32.000000),

            // وقت الرحلة
            'departure_time' => now()->addDay(),

            // المقاعد
            'available_seats' => fake()->numberBetween(1, 6),

            // السعر
            'price_per_seat' => fake()->randomFloat(2, 20, 300),
// 2 → رقمين بعد العلامة العشرية
// 20 → أقل سعر
// 300 → أكبر سعر

            // الحالة
            'status' => 'scheduled',

            // ملاحظات
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * حالة رحلة بدأت
     */
    public function inProgress(): static
    {
        return $this->state(fn () => [
            'status' => 'in_progress',
        ]);
    }

    /**
     * حالة رحلة منتهية
     */
    public function completed(): static
    {
        return $this->state(fn () => [
            'status' => 'completed',
        ]);
    }

    /**
     * حالة رحلة ملغية
     */
    public function cancelled(): static
    {
        return $this->state(fn () => [
            'status' => 'cancelled',
        ]);
    }
}
