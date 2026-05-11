<?php

namespace App\Models;

use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /** @use HasFactory<TripFactory> */
    use HasFactory;

    /**
     * الحقول المسموح بتعبئتها
     */
    protected $fillable = [
        'driver_id',
        'vehicle_id',
// عنوان البداية
        'start_address',

// إحداثيات البداية
        'start_lat',   // يعني خط العرض لنقطة البداية -  Latitude (lat) → شمال / جنوب
        'start_lng',   // يعني خط الطول لنقطة البداية - Longitude (lng) → شرق / غرب

// عنوان النهاية
        'end_address',

// إحداثيات النهاية
        'end_lat',
        'end_lng',

        'departure_time',              // وقت الانطلاق

        'available_seats',            // عدد المقاعد المتاحة

        'price_per_seat',            // السعر لكل مقعد

         // حالة الرحلة
            // scheduled = مجدولة
            // in_progress = بدأت
            // completed = انتهت
            // cancelled = أُلغيت
        'status',


        'notes',             // ملاحظات إضافية


    ];

    /**
     * التحويلات التلقائية
     */
    protected function casts(): array
    {
        return [
            'start_lat' => 'decimal:7', // 👉 ومسموح يكون فيها حد أقصى 7 أرقام بعد العلامة العشرية القيمة  - لازم تكون رقم عشري (Decimal)

            'start_lng' => 'decimal:7',
            'end_lat' => 'decimal:7',
            'end_lng' => 'decimal:7',
            'departure_time' => 'datetime',
            'available_seats' => 'integer',
            'price_per_seat' => 'decimal:2',
        ];
    }

    /**
     * السائق صاحب الرحلة
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * العربية المستخدمة في الرحلة
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * الركاب المنضمين للرحلة
     * سنستخدم العلاقة لاحقًا
     */
    public function passengers()
    {
        return $this->hasMany(TripPassenger::class);
    }

    // /**
    //  * طلبات المطابقة الخاصة بالرحلة
    //  * سنستخدمها لاحقًا
    //  */
    public function matches()
    {
        return $this->hasMany(RideMatch::class);
    }

public function messages()
{
    return $this->hasMany(Message::class);
}
}
