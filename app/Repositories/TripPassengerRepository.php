<?php

namespace App\Repositories;

use App\Interfaces\TripPassengerRepositoryInterface;
use App\Models\TripPassenger;
use Illuminate\Database\Eloquent\Collection;

class TripPassengerRepository implements TripPassengerRepositoryInterface
{
    public function create(array $data): TripPassenger
    {
        return TripPassenger::create($data);
    }

    public function getByTrip(int $tripId): Collection
    {
        return TripPassenger::with('user')
            ->where('trip_id', $tripId)
            ->get();
    }

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
