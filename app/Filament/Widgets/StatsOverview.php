<?php

namespace App\Filament\Widgets;

use App\Models\Trip;
use App\Models\User;
use App\Models\TripPassenger;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Total Trips', Trip::count())
                ->description('All trips in system')
                ->color('primary')
                ->chart($this->getTripsChart()),

            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->color('success')
                ->chart($this->getUsersChart()),

            Stat::make('Paid Bookings', TripPassenger::where('payment_status', 'paid')->count())
                ->description('Successful payments')
                ->color('warning')
                ->chart($this->getBookingsChart()),

            Stat::make('Revenue', $this->getRevenueTotal())
                ->description('Total earnings (EGP)')
                ->color('danger')
                ->chart($this->getRevenueChart()),

        ];
    }

    private function getTripsChart(): array
    {
        return Trip::selectRaw('count(*) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();
    }

    private function getUsersChart(): array
    {
        return User::selectRaw('count(*) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();
    }

    private function getBookingsChart(): array
    {
        return TripPassenger::where('payment_status', 'paid')
            ->selectRaw('count(*) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();
    }

    private function getRevenueChart(): array
    {
        return TripPassenger::where('payment_status', 'paid')
            ->selectRaw('SUM(total_price) as total')
            ->groupByRaw('DATE(created_at)')
            ->pluck('total')
            ->toArray();
    }

    private function getRevenueTotal(): string
    {
        return number_format(
            TripPassenger::where('payment_status', 'paid')->sum('total_price'),
            2
        ) . ' EGP';
    }
}
