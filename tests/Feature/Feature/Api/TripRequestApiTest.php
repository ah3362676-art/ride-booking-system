<?php

namespace Tests\Feature\Api;

use App\Models\TripRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripRequestApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار عرض طلبات الرحلات عبر API
     */
    public function test_authenticated_user_can_get_his_trip_requests_via_api(): void
    {
        $user = User::factory()->rider()->create();

        TripRequest::factory()->count(2)->create([
            'rider_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/trip-requests');

        $response->assertOk();
    }

    /**
     * اختبار إنشاء طلب رحلة عبر API
     */
    public function test_user_can_create_trip_request_via_api(): void
    {
        $user = User::factory()->rider()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/trip-requests', [
            'start_address' => 'Zayed',
            'start_lat' => 30.0100,
            'start_lng' => 31.0000,
            'end_address' => 'Mohandessin',
            'end_lat' => 30.0500,
            'end_lng' => 31.2000,
            'requested_seats' => 2,
            'notes' => 'رحلة API',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'trip_request' => [
                    'id',
                    'start_address',
                    'end_address',
                    'requested_seats',
                    'status',
                ],
            ]);

        $this->assertDatabaseHas('trip_requests', [
            'rider_id' => $user->id,
            'start_address' => 'Zayed',
            'requested_seats' => 2,
        ]);
    }

    /**
     * اختبار حذف طلب رحلة عبر API
     */
    public function test_user_can_delete_his_trip_request_via_api(): void
    {
        $user = User::factory()->rider()->create();

        $tripRequest = TripRequest::factory()->create([
            'rider_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/trip-requests/{$tripRequest->id}");

        $response->assertOk();

        $this->assertDatabaseMissing('trip_requests', [
            'id' => $tripRequest->id,
        ]);
    }
}
