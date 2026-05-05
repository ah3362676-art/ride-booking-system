<?php

namespace Tests\Feature\Vehicle;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleWebTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار عرض صفحة المركبات للمستخدم المسجل
     */
    public function test_authenticated_user_can_view_vehicles_index(): void
    {
        $user = User::factory()->driver()->create();

        $response = $this->actingAs($user)->get(route('vehicles.index'));

        $response->assertOk();
    }

    /**
     * اختبار إنشاء مركبة جديدة
     */
    public function test_user_can_create_vehicle(): void
    {
        $user = User::factory()->driver()->create();

        $response = $this->actingAs($user)->post(route('vehicles.store'), [
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'color' => 'White',
            'plate_number' => 'ABC-1234',
            'seats_count' => 4,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('vehicles.index'));

        $this->assertDatabaseHas('vehicles', [
            'user_id' => $user->id,
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'plate_number' => 'ABC-1234',
        ]);
    }

    /**
     * اختبار تعديل مركبة
     */
    public function test_user_can_update_his_vehicle(): void
    {
        $user = User::factory()->driver()->create();

        $vehicle = Vehicle::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put(route('vehicles.update', $vehicle->id), [
            'brand' => 'Hyundai',
            'model' => 'Elantra',
            'color' => 'Black',
            'plate_number' => $vehicle->plate_number,
            'seats_count' => 5,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('vehicles.index'));

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id,
            'brand' => 'Hyundai',
            'model' => 'Elantra',
            'color' => 'Black',
            'seats_count' => 5,
        ]);
    }

    /**
     * اختبار حذف مركبة
     */
    public function test_user_can_delete_his_vehicle(): void
    {
        $user = User::factory()->driver()->create();

        $vehicle = Vehicle::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('vehicles.destroy', $vehicle));

        $response->assertRedirect(route('vehicles.index'));

        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id,
        ]);
    }

    /**
     * اختبار أن المستخدم لا يستطيع تعديل مركبة لا تخصه
     */
    public function test_user_cannot_update_vehicle_of_another_user(): void
    {
        $owner = User::factory()->driver()->create();
        $otherUser = User::factory()->driver()->create();

        $vehicle = Vehicle::factory()->create([
            'user_id' => $owner->id,
        ]);

        $response = $this->actingAs($otherUser)->put(route('vehicles.update', $vehicle), [
            'brand' => 'Kia',
            'model' => 'Cerato',
            'color' => 'Blue',
            'plate_number' => $vehicle->plate_number,
            'seats_count' => 4,
            'is_active' => true,
        ]);

        $response->assertForbidden();
    }
}
