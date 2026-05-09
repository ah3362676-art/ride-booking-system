<?php

namespace Tests\Feature\RideMatch;

use App\Models\Trip;
use App\Models\TripRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RideMatchWebTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار توليد المطابقات لطلب رحلة
     */
    public function test_user_can_generate_matches_for_his_trip_request(): void
    {
        $rider = User::factory()->rider()->create();

        $driver = User::factory()->driver()->create();

        $vehicle = Vehicle::factory()->create([
            'user_id' => $driver->id,
            'is_active' => true,
            'seats_count' => 4,
        ]);

        Trip::factory()->create([
            'driver_id' => $driver->id,
            'vehicle_id' => $vehicle->id,
            'start_lat' => 30.0500,
            'start_lng' => 31.3500,
            'end_lat' => 29.9600,
            'end_lng' => 31.2600,
            'available_seats' => 3,
            'status' => 'scheduled',
        ]);

        $tripRequest = TripRequest::factory()->create([
            'rider_id' => $rider->id,
            'start_lat' => 30.0501,
            'start_lng' => 31.3501,
            'end_lat' => 29.9601,
            'end_lng' => 31.2601,
            'requested_seats' => 1,
        ]);

        $response = $this->actingAs($rider)->post(route('ride-matches.generate', $tripRequest));

        $response->assertRedirect();

        $this->assertDatabaseCount('ride_matches', 1);
    }

    /**
     * اختبار قبول مطابقة
     */
    public function test_user_can_accept_match(): void
    {
        $rider = User::factory()->rider()->create();
        $driver = User::factory()->driver()->create();

        $vehicle = Vehicle::factory()->create([
            'user_id' => $driver->id,
        ]);

        $trip = Trip::factory()->create([
            'driver_id' => $driver->id,
            'vehicle_id' => $vehicle->id,
        ]);

        $tripRequest = TripRequest::factory()->create([
            'rider_id' => $rider->id,
        ]);

        $match = \App\Models\RideMatch::factory()->create([
            'trip_request_id' => $tripRequest->id,
            'trip_id' => $trip->id,
            'status' => 'suggested',
        ]);

        $response = $this->actingAs($rider)->post(route('ride-matches.accept', [$tripRequest, $match]));

        $response->assertRedirect();

        $this->assertDatabaseHas('ride_matches', [
            'id' => $match->id,
            'status' => 'accepted',
        ]);

        $this->assertDatabaseHas('trip_requests', [
            'id' => $tripRequest->id,
            'status' => 'accepted',
            'matched_trip_id' => $trip->id,
        ]);
    }
}
