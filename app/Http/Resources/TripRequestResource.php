<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripRequestResource extends JsonResource
{
    /**
     * تحويل بيانات طلب الرحلة إلى JSON منظم
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rider_id' => $this->rider_id,
            'start_address' => $this->start_address,
            'start_lat' => $this->start_lat,
            'start_lng' => $this->start_lng,
            'end_address' => $this->end_address,
            'end_lat' => $this->end_lat,
            'end_lng' => $this->end_lng,
            'requested_seats' => $this->requested_seats,
            'status' => $this->status,
            'notes' => $this->notes,
            'matched_trip' => $this->whenLoaded('matchedTrip', function () {
                return [
                    'id' => $this->matchedTrip?->id,
                    'start_address' => $this->matchedTrip?->start_address,
                    'end_address' => $this->matchedTrip?->end_address,
                    'status' => $this->matchedTrip?->status,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
