<?php

namespace App\Events;

use App\Models\RideMatch;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public RideMatch $rideMatch)
    {}

    public function broadcastOn(): array
    {
        return [
            new Channel('driver-notifications'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'match.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->rideMatch->id,
            'trip_id' => $this->rideMatch->trip_id,
            'score' => $this->rideMatch->match_score,
            'status' => $this->rideMatch->status,
        ];
    }
}
