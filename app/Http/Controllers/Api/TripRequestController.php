<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest\StoreTripRequestRequest;
use App\Http\Requests\TripRequest\UpdateTripRequestRequest;
use App\Http\Resources\TripRequestResource;
use App\Interfaces\TripRequestRepositoryInterface;
use App\Models\TripRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TripRequestController extends Controller
{
    /**
     * حقن الـ repository
     */
    public function __construct(
        protected TripRequestRepositoryInterface $tripRequestRepository
    ) {}

    /**
     * عرض طلبات الراكب الحالي
     */
    public function index(): AnonymousResourceCollection
    {
        $tripRequests = $this->tripRequestRepository->paginateByRider(auth()->id(), 10);

        return TripRequestResource::collection($tripRequests);
    }

    /**
     * إنشاء طلب رحلة جديد
     */
    public function store(StoreTripRequestRequest $request): JsonResponse
    {
        $tripRequest = $this->tripRequestRepository->create([
            'rider_id' => auth()->id(),
            ...$request->validated(),
            'status' => 'pending',
            'matched_trip_id' => null,
        ]);

        return response()->json([
            'message' => 'تم إرسال طلب الرحلة بنجاح',
            'trip_request' => new TripRequestResource($tripRequest),
        ], 201);
    }

    /**
     * عرض طلب رحلة واحد
     */
    public function show(TripRequest $tripRequest): TripRequestResource
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $tripRequest->load('matchedTrip');

        return new TripRequestResource($tripRequest);
    }

    /**
     * تحديث طلب رحلة
     */
    public function update(UpdateTripRequestRequest $request, TripRequest $tripRequest): JsonResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $data = $request->validated();
        $data['status'] = 'pending';
        $data['matched_trip_id'] = null;

        $this->tripRequestRepository->update($tripRequest, $data);

        $tripRequest->refresh();

        return response()->json([
            'message' => 'تم تعديل طلب الرحلة بنجاح',
            'trip_request' => new TripRequestResource($tripRequest),
        ]);
    }

    /**
     * حذف طلب رحلة
     */
    public function destroy(TripRequest $tripRequest): JsonResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $this->tripRequestRepository->delete($tripRequest);

        return response()->json([
            'message' => 'تم حذف طلب الرحلة بنجاح',
        ]);
    }
}
