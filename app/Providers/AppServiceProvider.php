<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\RideMatchRepositoryInterface;
use App\Interfaces\TripPassengerRepositoryInterface;
use App\Interfaces\TripRepositoryInterface;
use App\Interfaces\TripRequestRepositoryInterface;
use App\Interfaces\VehicleRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\RideMatchRepository;
use App\Repositories\TripPassengerRepository;
use App\Repositories\TripRepository;
use App\Repositories\TripRequestRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ربط Auth interface بالـ repository
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);

        // ربط Vehicle interface بالـ repository
        $this->app->bind(VehicleRepositoryInterface::class, VehicleRepository::class);

        // ربط Trip interface بالـ repository
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);

        // ربط TripRequest interface بالـ repository
        $this->app->bind(TripRequestRepositoryInterface::class, TripRequestRepository::class);

        // ربط RideMatch interface بالـ repository
        $this->app->bind(RideMatchRepositoryInterface::class, RideMatchRepository::class);

        $this->app->bind(TripPassengerRepositoryInterface::class, TripPassengerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
