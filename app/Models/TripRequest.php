<?php

namespace App\Models;

use Database\Factories\TripRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripRequest extends Model
{
    /** @use HasFactory<TripRequestFactory> */
    use HasFactory;

    /**
     * الحقول المسموح بتعبئتها
     */
    protected $fillable = [
        'rider_id',
        'start_address',
        'start_lat',
        'start_lng',
        'end_address',
        'end_lat',
        'end_lng',
        'requested_seats',
        'status',
        'matched_trip_id',
        'notes',
    ];

// start_lat → خط العرض للبداية (Latitude)
// start_lng → خط الطول للبداية (Longitude)
// end_address → عنوان النهاية
// end_lat → خط العرض للنهاية
// end_lng → خط الطول للنهاية
// requested_seats → عدد الكراسي المطلوبة
// status → ( pending', 'matched', 'accepted', 'rejected', 'cancelled) حالة الطلب
// matched_trip_id → الرحلة اللي اتربط بيها الطلب
// notes → ملاحظات إضافية

    /**
     * التحويلات التلقائية
     */
    protected function casts(): array
    {
        return [
            'start_lat' => 'decimal:7',
            'start_lng' => 'decimal:7',
            'end_lat' => 'decimal:7',
            'end_lng' => 'decimal:7',
            'requested_seats' => 'integer',
            'matched_trip_id' => 'integer',
        ];
    }

    /**
     * الراكب صاحب الطلب
     */
    public function rider()
    {
        return $this->belongsTo(User::class, 'rider_id');
    }

    /**
     * الرحلة التي تم مطابقة الطلب معها
     */
    public function matchedTrip()   // لو كان اسمها تريب بس مش هكتب تحت اسم العمود
    {
        return $this->belongsTo(Trip::class, 'matched_trip_id');
    }

    /**
     * كل الترشيحات الخاصة بهذا الطلب
     * سنستخدمها لاحقًا في الـ matching
     */
    public function matches()
    {
        return $this->hasMany(RideMatch::class);
    }

    // /**
    //  * الراكب الذي تم قبوله فعليًا داخل رحلة
    //  * سنستخدمها لاحقًا
    //  */
    // public function passenger()
    // {
    //     return $this->hasOne(TripPassenger::class);
    // }
}
