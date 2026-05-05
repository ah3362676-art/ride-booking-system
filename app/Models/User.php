<?php

namespace App\Models;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use
    HasApiTokens,HasFactory,Notifiable;

    /**
     * الحقول المسموح بتعبئتها
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'is_active',
        'password',
    ];

    /**
     * الحقول المخفية عند التحويل لـ array أو json
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * التحويلات التلقائية للحقول
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'role' => Role::class,
        ];
    }

    /**
     * هل المستخدم أدمن؟
     */
    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }

    /**
     * هل المستخدم سائق؟
     */
    public function isDriver(): bool
    {
        return $this->role === Role::Driver;
    }

    /**
     * هل المستخدم راكب؟
     */
    public function isRider(): bool
    {
        return $this->role === Role::Rider;
    }

    /**
     * الرحلات التي يقودها هذا المستخدم
     * سنستخدمها لاحقًا عندما ننشئ Trip
     */
    public function driverTrips()
    {
        return $this->hasMany(Trip::class, 'driver_id');
    }

    // /**
    //  * طلبات الرحلات الخاصة بالراكب
    //  * سنستخدمها لاحقًا عندما ننشئ TripRequest
    //  */
    public function tripRequests()
    {
        return $this->hasMany(TripRequest::class, 'rider_id');
    }

    // /**
    //  * المركبات الخاصة بالمستخدم
    //  * سنستخدمها لاحقًا عند إنشاء Vehicle
    //  */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
