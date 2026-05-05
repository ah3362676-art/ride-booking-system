<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function __construct(
        protected VehicleRepositoryInterface $vehicleRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $vehicles=  $this->vehicleRepository->paginateByUser(auth()->id(), 10);
              return view('vehicles.index', compact('vehicles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                return view('vehicles.create');

    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(StoreVehicleRequest $request)
{
    $this->vehicleRepository->create(array_merge(
        $request->validated(),
        ['user_id' => auth()->id()]
    ));

    return redirect()
        ->route('vehicles.index')
        ->with('success', 'تم إضافة المركبة بنجاح');
}

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
         abort_if($vehicle->user_id !== auth()->id(), 403);

        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $this->vehicleRepository->update($vehicle, $request->validated());

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'تم تعديل المركبة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
            abort_if($vehicle->user_id !== auth()->id(), 403);

        $this->vehicleRepository->delete($vehicle);

        return redirect()
            ->route('vehicles.index')
            ->with('success', 'تم حذف المركبة بنجاح');
    }
}
