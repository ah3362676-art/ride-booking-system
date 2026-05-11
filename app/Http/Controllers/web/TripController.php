<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Interfaces\TripRepositoryInterface;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TripController extends Controller
{
    public function __construct(
        protected TripRepositoryInterface $tripRepository,
        protected VehicleRepositoryInterface $vehicleRepository,
    ) {}

    public function index(): View
    {
        $trips = $this->tripRepository->paginateByDriver(auth()->id());

        return view('trips.index', compact('trips'));
    }

    public function create(): View
    {
        $vehicles = $this->vehicleRepository->getActiveByUser(auth()->id());

        return view('trips.create', compact('vehicles'));
    }

    public function store(StoreTripRequest $request): RedirectResponse
    {
        $vehicle = $this->vehicleRepository
            ->getActiveByUser(auth()->id())
            ->firstWhere('id', (int) $request->vehicle_id);

        abort_if(! $vehicle, 403, 'هذه المركبة لا تخصك أو غير مفعلة');

        $this->tripRepository->create([
            'driver_id' => auth()->id(),
            ...$request->validated(),
        ]);

        return redirect()
            ->route('trips.index')
            ->with('success', 'تم إنشاء الرحلة بنجاح');
    }

    public function show(Trip $trip): View
    {
        abort_if($trip->driver_id !== auth()->id(), 404);

        $trip->load('vehicle');

        return view('trips.show', compact('trip'));
    }

    public function edit(Trip $trip): View
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $vehicles = $this->vehicleRepository->getActiveByUser(auth()->id());

        return view('trips.edit', compact('trip', 'vehicles'));
    }

    public function update(UpdateTripRequest $request, Trip $trip): RedirectResponse
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $vehicle = $this->vehicleRepository
            ->getActiveByUser(auth()->id())
            ->firstWhere('id', (int) $request->vehicle_id);

        abort_if(! $vehicle, 403, 'هذه المركبة لا تخصك أو غير مفعلة');

        $this->tripRepository->update($trip, $request->validated());

        return redirect()
            ->route('trips.index')
            ->with('success', 'تم تعديل الرحلة بنجاح');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $this->tripRepository->delete($trip);

        return redirect()
            ->route('trips.index')
            ->with('success', 'تم حذف الرحلة بنجاح');
    }
}
