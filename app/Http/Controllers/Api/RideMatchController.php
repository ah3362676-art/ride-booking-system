<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RideMatchResource;
use App\Interfaces\RideMatchRepositoryInterface;
use App\Models\RideMatch;
use App\Models\TripRequest;
use App\Services\MatchingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * عرض مطابقات طلب معين
     */
    public function index(TripRequest $tripRequest): AnonymousResourceCollection
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $matches = $this->rideMatchRepository->getByTripRequest($tripRequest->id);

        return RideMatchResource::collection($matches);
    }

    /**
     * توليد المطابقات عبر API
     */
    public function generate(TripRequest $tripRequest): JsonResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $matches = $this->matchingService->generateMatchesForTripRequest($tripRequest);

        return response()->json([
            'message' => 'تم توليد المطابقات بنجاح',
            'matches' => RideMatchResource::collection($matches),
        ]);
    }

    /**
     * عرض مطابقة واحدة
     */
    public function show(TripRequest $tripRequest, RideMatch $rideMatch): RideMatchResource
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);
        abort_if($rideMatch->trip_request_id !== $tripRequest->id, 404);

        $rideMatch->load(['trip.vehicle', 'trip.driver']);

        return new RideMatchResource($rideMatch);
    }

    /**
     * قبول مطابقة
     */
    public function accept(TripRequest $tripRequest, RideMatch $rideMatch): JsonResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);
        abort_if($rideMatch->trip_request_id !== $tripRequest->id, 404);

        $this->rideMatchRepository->update($rideMatch, [
            'status' => 'accepted',
        ]);

        $tripRequest->update([
            'status' => 'accepted',
            'matched_trip_id' => $rideMatch->trip_id,
        ]);

        foreach ($this->rideMatchRepository->getByTripRequest($tripRequest->id) as $match) {
            if ($match->id !== $rideMatch->id && $match->status === 'suggested') {
                $this->rideMatchRepository->update($match, [
                    'status' => 'rejected',
                ]);
            }
        }

        $rideMatch->refresh()->load(['trip.vehicle', 'trip.driver']);

        return response()->json([
            'message' => 'تم قبول المطابقة بنجاح',
            'match' => new RideMatchResource($rideMatch),
        ]);
    }

    /**
     * رفض مطابقة
     */
    public function reject(TripRequest $tripRequest, RideMatch $rideMatch): JsonResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);
        abort_if($rideMatch->trip_request_id !== $tripRequest->id, 404);

        $this->rideMatchRepository->update($rideMatch, [
            'status' => 'rejected',
        ]);

        $rideMatch->refresh()->load(['trip.vehicle', 'trip.driver']);

        return response()->json([
            'message' => 'تم رفض المطابقة',
            'match' => new RideMatchResource($rideMatch),
        ]);
    }
}
