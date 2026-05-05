<?php

namespace App\Interfaces;

use App\Models\Vehicle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface VehicleRepositoryInterface
{
    /**
     * جلب كل المركبات الخاصة بالمستخدم الحالي بشكل paginated
     */
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator;

    /**
     * إنشاء مركبة جديدة
     */
    public function create(array $data): Vehicle;

    /**
     * تحديث مركبة
     */
    public function update(Vehicle $vehicle, array $data): bool;

    /**
     * حذف مركبة
     */
    public function delete(Vehicle $vehicle): bool;

    /**
     * جلب المركبات المفعلة الخاصة بالمستخدم
     */
    public function getActiveByUser(int $userId): Collection;
}
