<?php

namespace App\Filament\Resources\TripPassengers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;

class TripPassengersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('trip.start_address')
                    ->label('From')
                    ->searchable()
                    ->limit(20),

                TextColumn::make('trip.end_address')
                    ->label('To')
                    ->searchable()
                    ->limit(20),

                TextColumn::make('user.name')
                    ->label('Passenger')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('seats_booked')
                    ->label('Seats')
                    ->sortable(),

                TextColumn::make('price_per_seat')
                    ->money('EGP')
                    ->label('Seat Price'),

                TextColumn::make('total_price')
                    ->money('EGP')
                    ->label('Total'),

                TextColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ]),

                TextColumn::make('payment_status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ]),

                TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->since()
                    ->label('Created'),

            ])

            ->filters([
                //
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
