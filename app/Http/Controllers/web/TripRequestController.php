<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest\StoreTripRequestRequest;
use App\Http\Requests\TripRequest\UpdateTripRequestRequest;
use App\Interfaces\TripRequestRepositoryInterface;
use App\Models\TripRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
    public function index(): View
    {
        $tripRequests = $this->tripRequestRepository->paginateByRider(auth()->id());

        return view('trip-requests.index', compact('tripRequests'));
    }

    /**
     * عرض صفحة إنشاء طلب جديد
     */
    public function create(): View
    {
        return view('trip-requests.create');
    }

    /**
     * تخزين طلب رحلة جديد
     */
    public function store(StoreTripRequestRequest $request): RedirectResponse
    {
        $this->tripRequestRepository->create([
            'rider_id' => auth()->id(),
            ...$request->validated(),
            'status' => 'pending',
            'matched_trip_id' => null,
        ]);

        return redirect()
            ->route('trip-requests.index')
            ->with('success', 'تم إرسال طلب الرحلة بنجاح');
    }

    /**
     * عرض تفاصيل طلب واحد
     */
    public function show(TripRequest $tripRequest): View
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $tripRequest->load('matchedTrip.vehicle');

        return view('trip-requests.show', compact('tripRequest'));
    }

    /**
     * عرض صفحة تعديل الطلب
     */
    public function edit(TripRequest $tripRequest): View
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        return view('trip-requests.edit', compact('tripRequest'));
    }

    /**
     * تحديث طلب الرحلة
     */
    public function update(UpdateTripRequestRequest $request, TripRequest $tripRequest): RedirectResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $data = $request->validated();

        // لو الراكب عدّل الطلب، نرجعه pending ونلغي أي matching قديم
        $data['status'] = 'pending';
        $data['matched_trip_id'] = null;

        $this->tripRequestRepository->update($tripRequest, $data);

        return redirect()
            ->route('trip-requests.index')
            ->with('success', 'تم تعديل طلب الرحلة بنجاح');
    }

    /**
     * حذف طلب الرحلة
     */
    public function destroy(TripRequest $tripRequest): RedirectResponse
    {
        abort_if($tripRequest->rider_id !== auth()->id(), 403);

        $this->tripRequestRepository->delete($tripRequest);

        return redirect()
            ->route('trip-requests.index')
            ->with('success', 'تم حذف طلب الرحلة بنجاح');
    }
}
