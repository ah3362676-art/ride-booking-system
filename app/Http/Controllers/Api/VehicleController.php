<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{
    /**
     * حقن الـ repository
     */
    public function __construct(
        protected VehicleRepositoryInterface $vehicleRepository
    ) {}

    /**
     * عرض مركبات المستخدم الحالي
     */
    public function index(): AnonymousResourceCollection
    {
        $vehicles = $this->vehicleRepository->paginateByUser(auth()->id(), 10);

        return VehicleResource::collection($vehicles);
    }

    /**
     * إنشاء مركبة جديدة
     */
    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = $this->vehicleRepository->create(array_merge( $request->validated(),['user_id' => auth()->id()]))

        return response()->json([
            'message' => 'تم إضافة المركبة بنجاح',
            'vehicle' => new VehicleResource($vehicle),
        ], 201);
    }

    /**
     * عرض مركبة واحدة
     */
    public function show(Vehicle $vehicle): VehicleResource
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        return new VehicleResource($vehicle);
    }

    /**
     * تحديث مركبة
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): JsonResponse
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $this->vehicleRepository->update($vehicle, $request->validated());

        $vehicle->refresh();

        return response()->json([
            'message' => 'تم تعديل المركبة بنجاح',
            'vehicle' => new VehicleResource($vehicle),
        ]);
    }

    /**
     * حذف مركبة
     */
    public function destroy(Vehicle $vehicle): JsonResponse
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $this->vehicleRepository->delete($vehicle);

        return response()->json([
            'message' => 'تم حذف المركبة بنجاح',
        ]);
    }
}
