<?php

namespace App\Filament\Resources\Trips\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TripForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('driver_id')
                    ->required()
                    ->numeric(),
                TextInput::make('vehicle_id')
                    ->required()
                    ->numeric(),
                TextInput::make('start_address')
                    ->required(),
                TextInput::make('start_lat')
                    ->required()
                    ->numeric(),
                TextInput::make('start_lng')
                    ->required()
                    ->numeric(),
                TextInput::make('end_address')
                    ->required(),
                TextInput::make('end_lat')
                    ->required()
                    ->numeric(),
                TextInput::make('end_lng')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('departure_time')
                    ->required(),
                TextInput::make('available_seats')
                    ->required()
                    ->numeric(),
                TextInput::make('price_per_seat')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
            'scheduled' => 'Scheduled',
            'in_progress' => 'In progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ])
                    ->default('scheduled')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
