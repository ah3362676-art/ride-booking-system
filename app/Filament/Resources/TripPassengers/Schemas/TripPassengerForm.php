<?php

namespace App\Filament\Resources\TripPassengers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TripPassengerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('trip_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('trip_request_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('seats_booked')
                    ->required()
                    ->numeric(),
                TextInput::make('price_per_seat')
                    ->required()
                    ->numeric(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
                TextInput::make('payment_status')
                    ->required()
                    ->default('pending'),
                TextInput::make('transaction_id')
                    ->default(null),
            ]);
    }
}
