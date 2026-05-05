<?php

namespace Tests\Feature\TripRequest;

use App\Models\TripRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripRequestWebTest extends TestCase
{
    use RefreshDatabase;

    /**
     * اختبار عرض صفحة طلبات الرحلات
     */
    public function test_authenticated_user_can_view_trip_requests_index(): void
    {
        $user = User::factory()->rider()->create();

        $response = $this->actingAs($user)->get(route('trip-requests.index'));

        $response->assertOk();
    }

    /**
     * اختبار إنشاء طلب رحلة
     */
    public function test_user_can_create_trip_request(): void
    {
        $user = User::factory()->rider()->create();

        $response = $this->actingAs($user)->post(route('trip-requests.store'), [
            'start_address' => 'Nasr City',
            'start_lat' => 30.0500,
            'start_lng' => 31.3500,
            'end_address' => 'Maadi',
            'end_lat' => 29.9600,
            'end_lng' => 31.2600,
            'requested_seats' => 2,
            'notes' => 'أحتاج مقعدين',
        ]);

        $response->assertRedirect(route('trip-requests.index'));

        $this->assertDatabaseHas('trip_requests', [
            'rider_id' => $user->id,
            'start_address' => 'Nasr City',
            'end_address' => 'Maadi',
            'requested_seats' => 2,
            'status' => 'pending',
        ]);
    }

    /**
     * اختبار تعديل طلب رحلة
     */
    public function test_user_can_update_his_trip_request(): void
    {
        $user = User::factory()->rider()->create();

        $tripRequest = TripRequest::factory()->create([
            'rider_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put(route('trip-requests.update', $tripRequest), [
            'start_address' => 'Heliopolis',
            'start_lat' => 30.0900,
            'start_lng' => 31.3200,
            'end_address' => 'Dokki',
            'end_lat' => 30.0400,
            'end_lng' => 31.2100,
            'requested_seats' => 3,
            'notes' => 'تم التعديل',
        ]);

        $response->assertRedirect(route('trip-requests.index'));

        $this->assertDatabaseHas('trip_requests', [
            'id' => $tripRequest->id,
            'start_address' => 'Heliopolis',
            'end_address' => 'Dokki',
            'requested_seats' => 3,
            'status' => 'pending',
        ]);
    }

    /**
     * اختبار حذف طلب رحلة
     */
    public function test_user_can_delete_his_trip_request(): void
    {
        $user = User::factory()->rider()->create();

        $tripRequest = TripRequest::factory()->create([
            'rider_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('trip-requests.destroy', $tripRequest));

        $response->assertRedirect(route('trip-requests.index'));

        $this->assertDatabaseMissing('trip_requests', [
            'id' => $tripRequest->id,
        ]);
    }

    /**
     * اختبار منع تعديل طلب لا يخص المستخدم
     */
    public function test_user_cannot_update_trip_request_of_another_user(): void
    {
        $owner = User::factory()->rider()->create();
        $otherUser = User::factory()->rider()->create();

        $tripRequest = TripRequest::factory()->create([
            'rider_id' => $owner->id,
        ]);

        $response = $this->actingAs($otherUser)->put(route('trip-requests.update', $tripRequest), [
            'start_address' => 'Test Start',
            'start_lat' => 30.1,
            'start_lng' => 31.2,
            'end_address' => 'Test End',
            'end_lat' => 30.2,
            'end_lng' => 31.3,
            'requested_seats' => 1,
            'notes' => 'test',
        ]);

        $response->assertForbidden();
    }
}
