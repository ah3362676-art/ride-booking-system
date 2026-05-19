<?php

namespace App\Repositories;

use App\Interfaces\TripPassengerRepositoryInterface;
use App\Models\TripPassenger;
use Illuminate\Database\Eloquent\Collection;

class TripPassengerRepository implements TripPassengerRepositoryInterface
{
        //👉 دالة لإنشاء راكب جديد في رحلة

    public function create(array $data): TripPassenger
    {
        return TripPassenger::create($data);
    }

        //هات كل الركاب في رحلة معينة
    public function getByTrip(int $tripId): Collection
    {
        return TripPassenger::with('user')
            ->where('trip_id', $tripId)
            ->get();
    }

        //هات كل الرحلات اللي شارك فيها راكب معين
    public function getByUser(int $userId): Collection
    {
        return TripPassenger::with('trip')
            ->where('user_id', $userId)
            ->get();
    }

    public function update(TripPassenger $tripPassenger, array $data): bool
    {
        return $tripPassenger->update($data);
    }

    public function delete(TripPassenger $tripPassenger): bool
    {
        return $tripPassenger->delete();
    }
}
