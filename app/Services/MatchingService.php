<?php

namespace App\Services;

use App\Events\MatchCreated;
use App\Interfaces\RideMatchRepositoryInterface;
use App\Models\Trip;
use App\Models\TripRequest;
use Illuminate\Database\Eloquent\Collection;

class MatchingService
{
    /**
     * حقن الـ repository
     */
    public function __construct(
        protected RideMatchRepositoryInterface $rideMatchRepository
    ) {}

    /**
     * تنفيذ المطابقة لطلب رحلة معين
     */
    public function generateMatchesForTripRequest(TripRequest $tripRequest): Collection
    {
        // حذف أي مطابقات قديمة مرتبطة بنفس الطلب
        $this->rideMatchRepository->deleteByTripRequest($tripRequest->id);

        // جلب الرحلات المرشحة
        $candidateTrips = Trip::query()
            ->with(['vehicle', 'driver'])
            ->where('status', 'scheduled')
            ->where('available_seats', '>=', $tripRequest->requested_seats)
            ->where('driver_id', '!=', $tripRequest->rider_id)
            ->get();

        $matches = collect();

        foreach ($candidateTrips as $trip) {
            // حساب درجة التطابق
            $scoreData = $this->calculateMatchScore($tripRequest, $trip);

            // تجاهل الرحلات ذات التطابق الضعيف جدًا
            if ($scoreData['score'] < 40) {
                continue;
            }

            $match = $this->rideMatchRepository->create([
                'trip_request_id' => $tripRequest->id,
                'trip_id' => $trip->id,
                'match_score' => $scoreData['score'],
                'match_reason' => $scoreData['reason'],
                'status' => 'suggested',
            ]);
            event(new MatchCreated($match));
            logger('broadcast fired');
            broadcast(new \App\Events\MatchAccepted($rideMatch));


            $matches->push($match);
        }

        // إعادة تحميل النتائج مرتبة من الأعلى للأقل
        $matches = $this->rideMatchRepository->getByTripRequest($tripRequest->id);

        // لو وجدنا نتائج، نحدث حالة الطلب
        if ($matches->isNotEmpty()) {
            $bestMatch = $matches->first();

            $tripRequest->update([
                'status' => 'matched',
                'matched_trip_id' => $bestMatch->trip_id,
            ]);
        } else {
            $tripRequest->update([
                'status' => 'pending',
                'matched_trip_id' => null,
            ]);
        }

        return $matches;
    }

    /**
     * حساب درجة التطابق بين الطلب والرحلة
     */
    protected function calculateMatchScore(TripRequest $tripRequest, Trip $trip): array
    {
        $score = 0;
        $reasons = [];

        // حساب قرب نقطة البداية
        $startDistance = $this->distance(
            (float) $tripRequest->start_lat,
            (float) $tripRequest->start_lng,
            (float) $trip->start_lat,
            (float) $trip->start_lng
        );

        // حساب قرب نقطة النهاية
        $endDistance = $this->distance(
            (float) $tripRequest->end_lat,
            (float) $tripRequest->end_lng,
            (float) $trip->end_lat,
            (float) $trip->end_lng
        );

        // نقاط البداية
        if ($startDistance <= 1) {
            $score += 40;
            $reasons[] = 'نقطة البداية قريبة جدًا';
        } elseif ($startDistance <= 3) {
            $score += 25;
            $reasons[] = 'نقطة البداية قريبة';
        } elseif ($startDistance <= 7) {
            $score += 10;
            $reasons[] = 'نقطة البداية مقبولة';
        }

        // نقاط النهاية
        if ($endDistance <= 1) {
            $score += 40;
            $reasons[] = 'نقطة النهاية قريبة جدًا';
        } elseif ($endDistance <= 3) {
            $score += 25;
            $reasons[] = 'نقطة النهاية قريبة';
        } elseif ($endDistance <= 7) {
            $score += 10;
            $reasons[] = 'نقطة النهاية مقبولة';
        }

        // المقاعد
        if ($trip->available_seats >= $tripRequest->requested_seats) {
            $score += 10;
            $reasons[] = 'عدد المقاعد مناسب';
        }

        // بونص لو الرحلة نفسها قريبة جدًا في البداية والنهاية
        if ($startDistance <= 2 && $endDistance <= 2) {
            $score += 10;
            $reasons[] = 'المسار متقارب جدًا';
        }

        return [
            'score' => min($score, 100),
             //لو الاسكور اقل من 100 هيرجع الاسكور لو اعلي هيرجه 100
            'reason' => implode(' - ', $reasons),
        ];
    }

    /**
     * حساب المسافة التقريبية بين نقطتين بالكيلومتر
     * باستخدام صيغة Haversine
     */
    protected function distance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371;   //ده رقم ثابت = نصف قطر الأرض بالكيلومتر

//  بنجيب الفرق
// فرق خطوط العرض (lat)
// فرق خطوط الطول (lng)
//  بنحوّل لراديان
// :  مش بتشتغل بالدرجات، لازم راديان   sin و cos  الدوال زي

        $dLat = deg2rad($lat2 - $lat1);   // فرق خطوط العرض (lat)

        $dLng = deg2rad($lng2 - $lng1);  // فرق خطوط الطول (lng)

        // sqrt => الجذر التربيعي
        //sin => الجيب
        $a = sin($dLat / 2) * sin($dLat / 2)+ cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) * sin($dLng / 2);


        //atan2 => دالة بتحوّل رقمين لزاوية

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;   // النتيجة بالكيلومتر
    }
}
