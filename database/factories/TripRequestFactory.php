<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripRequestFactory extends Factory
{
    /**
     * البيانات الافتراضية لطلب الرحلة
     */
    public function definition(): array
    {
        return [
            // إنشاء راكب افتراضي
            'rider_id' => User::factory()->rider(),

            // بيانات البداية
            'start_address' => fake()->streetAddress(),
            'start_lat' => fake()->latitude(29.800000, 31.500000),
            'start_lng' => fake()->longitude(30.900000, 32.000000),

            // بيانات النهاية
            'end_address' => fake()->streetAddress(),
            'end_lat' => fake()->latitude(29.800000, 31.500000),
            'end_lng' => fake()->longitude(30.900000, 32.000000),

            // عدد المقاعد المطلوبة
            'requested_seats' => fake()->numberBetween(1, 4),

            // الحالة
            'status' => 'pending',

            // الرحلة المطابقة
            'matched_trip_id' => null,

            // ملاحظات
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * حالة تم مطابقتها
     */
    public function matched(int $tripId): static
    {
        return $this->state(fn () => [
            'status' => 'matched',
            'matched_trip_id' => $tripId,
        ]);
    }

    /**
     * حالة مقبولة
     */
    public function accepted(int $tripId): static
    {
        return $this->state(fn () => [
            'status' => 'accepted',
            'matched_trip_id' => $tripId,
        ]);
    }

    /**
     * حالة مرفوضة
     */
    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
        ]);
    }

    /**
     * حالة ملغية
     */
    public function cancelled(): static
    {
        return $this->state(fn () => [
            'status' => 'cancelled',
        ]);
    }
}
