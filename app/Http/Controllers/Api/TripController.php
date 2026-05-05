<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Interfaces\TripRepositoryInterface;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TripController extends Controller
{
    /**
     * حقن الـ repositories
     */
    public function __construct(
        protected TripRepositoryInterface $tripRepository,
        protected VehicleRepositoryInterface $vehicleRepository,
    ) {}

    /**
     * عرض رحلات السائق الحالي
     */
    public function index(): AnonymousResourceCollection
    {
        $trips = $this->tripRepository->paginateByDriver(auth()->id(), 10);

        return TripResource::collection($trips);
    }

    /**
     * إنشاء رحلة جديدة
     */
    public function store(StoreTripRequest $request): JsonResponse
    {
        $vehicle = $this->vehicleRepository
            ->getActiveByUser(auth()->id())
            ->firstWhere('id', (int) $request->vehicle_id);

        abort_if(! $vehicle, 403, 'هذه المركبة لا تخصك أو غير مفعلة');

        $trip = $this->tripRepository->create([
            'driver_id' => auth()->id(),
            ...$request->validated(),
            'status' => $request->validated()['status'] ?? 'scheduled',
        ]);

        $trip->load('vehicle');

        return response()->json([
            'message' => 'تم إنشاء الرحلة بنجاح',
            'trip' => new TripResource($trip),
        ], 201);
    }

    /**
     * عرض رحلة واحدة
     */
    public function show(Trip $trip): TripResource
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $trip->load('vehicle');

        return new TripResource($trip);
    }

    /**
     * تحديث رحلة
     */
    public function update(UpdateTripRequest $request, Trip $trip): JsonResponse
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $vehicle = $this->vehicleRepository
            ->getActiveByUser(auth()->id())
            ->firstWhere('id', (int) $request->vehicle_id);

        abort_if(! $vehicle, 403, 'هذه المركبة لا تخصك أو غير مفعلة');

        $this->tripRepository->update($trip, $request->validated());

        $trip->refresh()->load('vehicle');

        return response()->json([
            'message' => 'تم تعديل الرحلة بنجاح',
            'trip' => new TripResource($trip),
        ]);
    }

    /**
     * حذف رحلة
     */
    public function destroy(Trip $trip): JsonResponse
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $this->tripRepository->delete($trip);

        return response()->json([
            'message' => 'تم حذف الرحلة بنجاح',
        ]);
    }
}
