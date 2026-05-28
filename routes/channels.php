<?php

use App\Models\Trip;
use App\Models\TripPassenger;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('trip-chat.{tripId}', function ($user, $tripId) {

    $trip = Trip::find($tripId);

    if (! $trip) {
        return false;
    }

    return
        $trip->driver_id === $user->id
        || TripPassenger::where
        ('trip_id', $tripId)
        ->where('user_id', $user->id)
        ->exists();
});
