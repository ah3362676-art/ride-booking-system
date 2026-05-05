<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\RideMatchRepositoryInterface;
use App\Models\RideMatch;
use App\Models\TripRequest;
use App\Services\MatchingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RideMatchController extends Controller
{
    /**
     * حقن الـ repository والـ service
     */
    public function __construct(
        protected RideMatchRepositoryInterface $rideMatchRepository,
        protected MatchingService $matchingService,
    ) {}

    /**
     * عرض كل المطابقات لطلب رحلة معين
     */
    public function index(TripRequest $tripRequest): View
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $matches = $this->rideMatchRepository->getByTripRequest($tripRequest->id);

        return view('ride-matches.index', compact('tripRequest', 'matches'));
    }

    /**
     * تنفيذ المطابقة يدويًا لطلب معين
     */
    public function generate(TripRequest $tripRequest): RedirectResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $this->matchingService->generateMatchesForTripRequest($tripRequest);

        return redirect()
            ->route('ride-matches.index', $tripRequest)
            ->with('success', 'تم توليد المطابقات بنجاح');
    }

    /**
     * عرض تفاصيل مطابقة واحدة
     */
    public function show(TripRequest $tripRequest, RideMatch $rideMatch): View
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);
        abort_if($rideMatch->trip_request_id !== $tripRequest->id, 404);

        $rideMatch->load(['trip.vehicle', 'trip.driver', 'tripRequest']);

        return view('ride-matches.show', compact('tripRequest', 'rideMatch'));
    }

    /**
     * قبول مطابقة معينة
     */
    public function accept(TripRequest $tripRequest, RideMatch $rideMatch): RedirectResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);
        abort_if($rideMatch->trip_request_id !== $tripRequest->id, 404);

        // تحديث المطابقة الحالية
        $this->rideMatchRepository->update($rideMatch, [
            'status' => 'accepted',
        ]);

        // تحديث الطلب نفسه
        $tripRequest->update([
            'status' => 'accepted',
            'matched_trip_id' => $rideMatch->trip_id,
        ]);

        // رفض باقي المطابقات الأخرى
        foreach ($this->rideMatchRepository->getByTripRequest($tripRequest->id) as $match) {
            if ($match->id !== $rideMatch->id && $match->status === 'suggested') {
                $this->rideMatchRepository->update($match, [
                    'status' => 'rejected',
                ]);
            }
        }

        return redirect()
            ->route('ride-matches.index', $tripRequest)
            ->with('success', 'تم قبول المطابقة بنجاح');
    }

    /**
     * رفض مطابقة معينة
     */
    public function reject(TripRequest $tripRequest, RideMatch $rideMatch): RedirectResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);
        abort_if($rideMatch->trip_request_id !== $tripRequest->id, 404);

        $this->rideMatchRepository->update($rideMatch, [
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('ride-matches.index', $tripRequest)
            ->with('success', 'تم رفض المطابقة');
    }
}
