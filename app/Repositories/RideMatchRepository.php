<?php

namespace App\Repositories;

use App\Interfaces\RideMatchRepositoryInterface;
use App\Models\RideMatch;
use Illuminate\Database\Eloquent\Collection;

class RideMatchRepository implements RideMatchRepositoryInterface
{
    /**
     * جلب كل المطابقات الخاصة بطلب رحلة معين
     */
    public function getByTripRequest(int $tripRequestId): Collection
    {
        return RideMatch::query()
            ->with(['trip.vehicle', 'trip.driver', 'tripRequest'])
            ->where('trip_request_id', $tripRequestId)
            ->orderByDesc('match_score')
            ->get();
    }

    /**
     * إنشاء مطابقة جديدة
     */
    public function create(array $data): RideMatch
    {
        return RideMatch::create($data);
    }

    /**
     * حذف كل المطابقات القديمة الخاصة بطلب معين
     */
    public function deleteByTripRequest(int $tripRequestId): bool
    {
        return RideMatch::query()
            ->where('trip_request_id', $tripRequestId)
            ->delete() > 0;
    }

    /**
     * تحديث بيانات المطابقة
     */
    public function update(RideMatch $rideMatch, array $data): bool
    {
        return $rideMatch->update($data);
    }

    /**
     * جلب أفضل مطابقة
     */
    public function getBestMatch(int $tripRequestId): ?RideMatch
    {
        return RideMatch::query()
            ->with(['trip.vehicle', 'trip.driver'])
            ->where('trip_request_id', $tripRequestId)
            ->orderByDesc('match_score')
            ->first();
    }
}
