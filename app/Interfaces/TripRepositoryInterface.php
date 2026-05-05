<?php

namespace App\Interfaces;

use App\Models\Trip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TripRepositoryInterface
{
    /**
     * جلب رحلات السائق الحالي
     */
    public function paginateByDriver(int $driverId, int $perPage = 10): LengthAwarePaginator;

    /**
     * إنشاء رحلة جديدة
     */
    public function create(array $data): Trip;

    /**
     * تحديث رحلة
     */
    public function update(Trip $trip, array $data): bool;

    /**
     * حذف رحلة
     */
    public function delete(Trip $trip): bool;
}
