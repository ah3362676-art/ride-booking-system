<?php

namespace App\Filament\Resources\TripPassengers\Pages;

use App\Filament\Resources\TripPassengers\TripPassengerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTripPassengers extends ListRecords
{
    protected static string $resource = TripPassengerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
