<?php

namespace App\Models;

use Database\Factories\TripPassengerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripPassenger extends Model
{
    use HasFactory;

    /**
     * الحقول المسموح تعبئتها
     */
    protected $fillable = [
        'trip_id',
        'user_id',
        'trip_request_id',
        'seats_booked',
        'price_per_seat',
        'total_price',
        'status',
        'payment_status',
        'transaction_id',
    ];

    /**
     * التحويلات
     */
    protected function casts(): array
    {
        return [
            'price_per_seat' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    /**
     * الرحلة
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * الراكب
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * الطلب المرتبط
     */
    public function tripRequest()
    {
        return $this->belongsTo(TripRequest::class);
    }
}
