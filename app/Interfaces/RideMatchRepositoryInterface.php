<?php

namespace App\Interfaces;

use App\Models\RideMatch;
use Illuminate\Database\Eloquent\Collection;

interface RideMatchRepositoryInterface
{
    /**
     * جلب كل المطابقات الخاصة بطلب رحلة معين
     */
    public function getByTripRequest(int $tripRequestId): Collection;

    /**
     * إنشاء مطابقة جديدة
     */
    public function create(array $data): RideMatch;

    /**
     * حذف كل المطابقات القديمة الخاصة بطلب معين
     */
    public function deleteByTripRequest(int $tripRequestId): bool;

    /**
     * تحديث حالة المطابقة
     */
    public function update(RideMatch $rideMatch, array $data): bool;

    /**
     * جلب أفضل مطابقة لطلب معين
     */
    public function getBestMatch(int $tripRequestId): ?RideMatch;
}
