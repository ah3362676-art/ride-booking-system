<?php

namespace App\Interfaces;

use App\Models\TripRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TripRequestRepositoryInterface
{
    /**
     * جلب طلبات الراكب الحالية
     */
    public function paginateByRider(int $riderId, int $perPage = 10): LengthAwarePaginator;

    /**
     * إنشاء طلب رحلة جديد
     */
    public function create(array $data): TripRequest;

    /**
     * تحديث طلب رحلة
     */
    public function update(TripRequest $tripRequest, array $data): bool;

    /**
     * حذف طلب رحلة
     */
    public function delete(TripRequest $tripRequest): bool;
}
