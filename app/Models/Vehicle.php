<?php

namespace App\Models;

use Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<VehicleFactory> */
    use HasFactory;

    /**
     * الحقول المسموح بتعبئتها
     */
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'color',
        'plate_number',
        'seats_count',
        'is_active',
    ];

    /**
     * التحويلات التلقائية
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'seats_count' => 'integer',
        ];
    }

    /**
     * مالك المركبة
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الرحلات المرتبطة بهذه المركبة
     * سنستخدمها لاحقًا عند إنشاء Trip
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
