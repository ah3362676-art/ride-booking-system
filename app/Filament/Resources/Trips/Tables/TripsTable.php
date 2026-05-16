<?php

namespace App\Filament\Resources\Trips\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TripsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('driver_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vehicle_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_address')
                    ->searchable(),
                TextColumn::make('start_lat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_lng')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_address')
                    ->searchable(),
                TextColumn::make('end_lat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('end_lng')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('departure_time')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('available_seats')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_per_seat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
