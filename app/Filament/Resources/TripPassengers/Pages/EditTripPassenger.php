<?php

namespace App\Filament\Resources\TripPassengers\Pages;

use App\Filament\Resources\TripPassengers\TripPassengerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTripPassenger extends EditRecord
{
    protected static string $resource = TripPassengerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
