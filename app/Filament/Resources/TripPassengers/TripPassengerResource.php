<?php

namespace App\Filament\Resources\TripPassengers;

use App\Filament\Resources\TripPassengers\Pages\CreateTripPassenger;
use App\Filament\Resources\TripPassengers\Pages\EditTripPassenger;
use App\Filament\Resources\TripPassengers\Pages\ListTripPassengers;
use App\Filament\Resources\TripPassengers\Schemas\TripPassengerForm;
use App\Filament\Resources\TripPassengers\Tables\TripPassengersTable;
use App\Models\TripPassenger;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TripPassengerResource extends Resource
{
    protected static ?string $model = TripPassenger::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return TripPassengerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TripPassengersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTripPassengers::route('/'),
            'create' => CreateTripPassenger::route('/create'),
            'edit' => EditTripPassenger::route('/{record}/edit'),
        ];
    }
}
