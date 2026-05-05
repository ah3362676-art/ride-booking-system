<?php

namespace App\Repositories;

use App\Interfaces\TripRepositoryInterface;
use App\Models\Trip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TripRepository implements TripRepositoryInterface
{
    /**
     * جلب رحلات السائق الحالي مع تحميل المركبة
     */
    public function paginateByDriver(int $driverId, int $perPage = 10): LengthAwarePaginator
    {
        return Trip::query()
            ->with('vehicle')
            ->where('driver_id', $driverId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * إنشاء رحلة جديدة
     */
    public function create(array $data): Trip
    {
        return Trip::create($data);
    }

    /**
     * تحديث رحلة
     */
    public function update(Trip $trip, array $data): bool
    {
        return $trip->update($data);
    }

    /**
     * حذف رحلة
     */
    public function delete(Trip $trip): bool
    {
        return $trip->delete();
    }
}
