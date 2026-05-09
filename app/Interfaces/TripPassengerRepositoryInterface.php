<?php

namespace App\Interfaces;

use App\Models\TripPassenger;
use Illuminate\Database\Eloquent\Collection;

interface TripPassengerRepositoryInterface
{
    //👉 دالة لإنشاء راكب جديد في رحلة
    public function create(array $data): TripPassenger;

    //هات كل الركاب في رحلة معينة

    public function getByTrip(int $tripId): Collection;

    //هات كل الرحلات اللي شارك فيها راكب معين
    public function getByUser(int $userId): Collection;

    //تحديث بيانات راكب في رحلة
    public function update(TripPassenger $tripPassenger, array $data): bool;

    //حذف راكب من رحلة
    public function delete(TripPassenger $tripPassenger): bool;
}
