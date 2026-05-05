<?php

namespace App\Repositories;

use App\Interfaces\TripRequestRepositoryInterface;
use App\Models\TripRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TripRequestRepository implements TripRequestRepositoryInterface
{
    /**
     * جلب طلبات الراكب الحالي مع تحميل الرحلة المطابقة إن وجدت
     */
    public function paginateByRider(int $riderId, int $perPage = 10): LengthAwarePaginator
    {
        return TripRequest::query()
            ->with('matchedTrip.vehicle')
            ->where('rider_id', $riderId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * إنشاء طلب رحلة جديد
     */
    public function create(array $data): TripRequest
    {
        return TripRequest::create($data);
    }

    /**
     * تحديث طلب رحلة
     */
    public function update(TripRequest $tripRequest, array $data): bool
    {
        return $tripRequest->update($data);
    }

    /**
     * حذف طلب رحلة
     */
    public function delete(TripRequest $tripRequest): bool
    {
        return $tripRequest->delete();
    }
}
