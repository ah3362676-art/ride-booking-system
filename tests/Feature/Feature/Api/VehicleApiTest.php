<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار عرض المركبات عبر API
     */
    public function test_authenticated_user_can_get_his_vehicles_via_api(): void
    {
        $user = User::factory()->driver()->create();

        Vehicle::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/vehicles');

        $response->assertOk();
    }

    /**
     * اختبار إنشاء مركبة عبر API
     */
    public function test_user_can_create_vehicle_via_api(): void
    {
        $user = User::factory()->driver()->create();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/vehicles', [
            'brand' => 'Nissan',
            'model' => 'Sunny',
            'color' => 'Silver',
            'plate_number' => 'XYZ-7788',
            'seats_count' => 4,
            'is_active' => true,
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'vehicle' => [
                    'id',
                    'brand',
                    'model',
                    'plate_number',
                ],
            ]);

        $this->assertDatabaseHas('vehicles', [
            'user_id' => $user->id,
            'plate_number' => 'XYZ-7788',
        ]);
    }

    /**
     * اختبار حذف مركبة عبر API
     */
    public function test_user_can_delete_his_vehicle_via_api(): void
    {
        $user = User::factory()->driver()->create();

        $vehicle = Vehicle::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'sanctum')->deleteJson("/api/vehicles/{$vehicle->id}");

        $response->assertOk();

        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id,
        ]);
    }
}
