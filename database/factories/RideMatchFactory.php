<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\TripRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class RideMatchFactory extends Factory
{
    /**
     * البيانات الافتراضية للمطابقة
     */
    public function definition(): array
    {
        return [
            // طلب الرحلة
            'trip_request_id' => TripRequest::factory(),

            // الرحلة المقترحة
            'trip_id' => Trip::factory(),

            // درجة المطابقة
            'match_score' => fake()->randomFloat(2, 40, 100),

            // سبب المطابقة
            'match_reason' => fake()->sentence(),

            // الحالة الافتراضية
            'status' => 'suggested',
        ];
    }

    /**
     * حالة مقبولة
     */
    public function accepted(): static
    {
        return $this->state(fn () => [
            'status' => 'accepted',
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
}
