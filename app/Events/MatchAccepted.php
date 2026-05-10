<?php

namespace App\Events;

use App\Models\RideMatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchAccepted implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public function __construct(public RideMatch $rideMatch)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('driver-notifications'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'match.accepted';
    }
    public function broadcastWith(): array
{
    return [
        'trip_id' => $this->rideMatch->trip_id,
        'status' => $this->rideMatch->status,
    ];
}
}
