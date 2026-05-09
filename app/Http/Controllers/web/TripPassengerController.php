<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\TripPassengerRepositoryInterface;

class TripPassengerController extends Controller
{
    public function __construct(
        protected TripPassengerRepositoryInterface $repository
    ) {}

    /**
     * رحلاتي كراكب
     */
    public function myTrips()
    {
        $trips = $this->repository->getByUser(auth()->id());

        return view('trip-passengers.my-trips', compact('trips'));
    }
}
