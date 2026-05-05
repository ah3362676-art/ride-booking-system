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
    public function index(): View
    {
        $trips = $this->tripRepository->paginateByDriver(auth()->id());
        return view('trips.index', compact('trips'));
    }

    /**
     * عرض صفحة إنشاء رحلة
     */
    public function create(): View
    {
        // جلب المركبات المفعلة فقط الخاصة بالمستخدم الحالي
        $vehicles = $this->vehicleRepository->getActiveByUser(auth()->id());

        return view('trips.create', compact('vehicles'));
    }

    /**
     * تخزين رحلة جديدة
     */
    public function store(StoreTripRequest $request): RedirectResponse
    {
        // حماية إضافية: التأكد أن المركبة تخص المستخدم الحالي
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

    /**
     * عرض تفاصيل رحلة واحدة
     */
    public function show(Trip $trip): View
    {
if ($trip->driver_id !== auth()->id()) {
    abort(404);
}
        $trip->load('vehicle');

        return view('trips.show', compact('trip'));
    }

    /**
     * عرض صفحة تعديل الرحلة
     */
    public function edit(Trip $trip): View
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $vehicles = $this->vehicleRepository->getActiveByUser(auth()->id());

        return view('trips.edit', compact('trip', 'vehicles'));
    }

    /**
     * تحديث الرحلة
     */
    public function update(UpdateTripRequest $request, Trip $trip): RedirectResponse
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        // التأكد أن المركبة المختارة تخص نفس السائق
        $vehicle = $this->vehicleRepository
            ->getActiveByUser(auth()->id())
            ->firstWhere('id', (int) $request->vehicle_id);

        abort_if(! $vehicle, 403, 'هذه المركبة لا تخصك أو غير مفعلة');

        $this->tripRepository->update($trip, $request->validated());

        return redirect()
            ->route('trips.index')
            ->with('success', 'تم تعديل الرحلة بنجاح');
    }

    /**
     * حذف الرحلة
     */
    public function destroy(Trip $trip): RedirectResponse
    {
        abort_if($trip->driver_id !== auth()->id(), 403);

        $this->tripRepository->delete($trip);

        return redirect()
            ->route('trips.index')
            ->with('success', 'تم حذف الرحلة بنجاح');
    }
}
