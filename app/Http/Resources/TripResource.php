<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * تحويل بيانات الرحلة إلى JSON منظم
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'driver_id' => $this->driver_id,
            'vehicle' => $this->whenLoaded('vehicle', function () {
                return [
                    'id' => $this->vehicle?->id,
                    'brand' => $this->vehicle?->brand,
                    'model' => $this->vehicle?->model,
                    'plate_number' => $this->vehicle?->plate_number,
                ];
            }),
            'start_address' => $this->start_address,
            'start_lat' => $this->start_lat,
            'start_lng' => $this->start_lng,
            'end_address' => $this->end_address,
            'end_lat' => $this->end_lat,
            'end_lng' => $this->end_lng,
            'departure_time' => $this->departure_time,
            'available_seats' => $this->available_seats,
            'price_per_seat' => $this->price_per_seat,
            'status' => $this->status,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
