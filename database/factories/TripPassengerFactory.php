<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\TripRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripPassengerFactory extends Factory
{
    public function definition(): array
    {
        $seats = fake()->numberBetween(1, 3);
        $price = fake()->randomFloat(2, 20, 100);

        return [
            'trip_id' => Trip::factory(),
            'user_id' => User::factory(),
            'trip_request_id' => TripRequest::factory(),
            'seats_booked' => $seats,
            'price_per_seat' => $price,
            'total_price' => $seats * $price,
            'status' => 'confirmed',
        ];
    }
}
