<?php

namespace App\Models;

use Database\Factories\RideMatchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RideMatch extends Model
{
    /** @use HasFactory<RideMatchFactory> */
    use HasFactory;

    /**
     * الحقول المسموح بتعبئتها
     */
    protected $fillable = [
        'trip_request_id',
        'trip_id',
        'match_score',
        'match_reason',
        'status',
    ];

    /**
     * التحويلات التلقائية
     */
    protected function casts(): array
    {
        return [
            'match_score' => 'decimal:2',
        ];
    }

    /**
     * طلب الرحلة المرتبط بهذه المطابقة
     */
    public function tripRequest()
    {
        return $this->belongsTo(TripRequest::class);
    }

    /**
     * الرحلة المقترحة في هذه المطابقة
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
