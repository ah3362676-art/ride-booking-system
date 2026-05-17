<?php

namespace App\Filament\Resources\TripPassengers\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TripPassengerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('trip_id')
                    ->relationship('trip', 'start_address')
                    ->searchable()
                    ->required()
                    ->label('Trip'),

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->label('Passenger'),

                Select::make('trip_request_id')
                    ->relationship('tripRequest', 'id')
                    ->searchable()
                    ->label('Trip Request'),

                TextInput::make('seats_booked')
                    ->numeric()
                    ->required()
                    ->label('Seats Booked'),

                TextInput::make('price_per_seat')
                    ->numeric()
                    ->required()
                    ->prefix('EGP')
                    ->label('Price Per Seat'),

                TextInput::make('total_price')
                    ->numeric()
                    ->required()
                    ->prefix('EGP')
                    ->label('Total Price'),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending')
                    ->label('Status'),

                Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->required()
                    ->label('Payment Status'),

                TextInput::make('transaction_id')
                    ->label('Transaction ID'),

            ]);
    }
}
