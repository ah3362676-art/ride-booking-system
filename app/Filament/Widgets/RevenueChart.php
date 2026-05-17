<?php

namespace App\Filament\Widgets;

use App\Models\TripPassenger;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue Analytics';

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = now()->subDays($i)->startOfDay();

            $total = TripPassenger::whereDate('created_at', $date)
                ->where('payment_status', 'paid')
                ->sum('total_price');

            $data[] = $total;
            $labels[] = now()->subDays($i)->format('D');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
