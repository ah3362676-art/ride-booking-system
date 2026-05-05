<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegisterRequest;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository implements VehicleRepositoryInterface
{
    /**
     * إنشاء مستخدم جديد من بيانات التسجيل
     */
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Vehicle::query()
            ->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }
    public function  create(array $data ):Vehicle
    {
return Vehicle::create($data);
}
    public function  update(Vehicle $vehicle, array $data ):bool
    {
       return $vehicle->update($data);


}
    public function  delete(Vehicle $vehicle ):bool
    {
return $vehicle->delete();
}
    public function getActiveByUser(int $userId): Collection
    {
        return Vehicle::query()
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->latest()
            ->get();
    }
}
