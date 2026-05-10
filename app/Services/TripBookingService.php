<?php

namespace App\Services;

use App\Interfaces\TripPassengerRepositoryInterface;
use App\Models\Trip;
use App\Models\TripRequest;
use Illuminate\Support\Facades\DB;

class TripBookingService
{
    public function __construct(
        protected TripPassengerRepositoryInterface $tripPassengerRepository
    ) {}

    /**
     * حجز رحلة بناءً على المطابقة
     */
    public function bookFromMatch(TripRequest $tripRequest, Trip $trip)
    {
        return DB::transaction(function () use ($tripRequest, $trip) {

            // تأكد إن في مقاعد كفاية
            if ($trip->available_seats < $tripRequest->requested_seats) {
                throw new \Exception("لا يوجد مقاعد كافية");
            }

            // حساب السعر
            $seats = $tripRequest->requested_seats;
            $price = $trip->price_per_seat;

            // إنشاء الحجز
            $booking = $this->tripPassengerRepository->create([
                'trip_id' => $trip->id,
                'user_id' => $tripRequest->rider_id,
                'trip_request_id' => $tripRequest->id,
                'seats_booked' => $seats,
                'price_per_seat' => $price,
                'total_price' => $seats * $price,
                'status' => 'confirmed',
            ]);

            // تقليل المقاعد
            $trip->decrement('available_seats', $seats);

            // تحديث الطلب
            $tripRequest->update([
                'status' => 'accepted',
            ]);

            return $booking;
        });
    }
}
