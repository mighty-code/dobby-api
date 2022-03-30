<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'departure_from' => $this->departure_from,
            'departure_at' => $this->departure_at?->toIso8601String(),
            'departure_delay' => $this->departure_delay,
            'departure_platform' => $this->departure_platform,
            'arrival_to' => $this->arrival_to,
            'arrival_at' => $this->arrival_at?->toIso8601String(),
            'arrival_delay' => $this->arrival_delay,
            'arrival_platform' => $this->arrival_platform,
            'duration_minutes' => $this->duration_minutes,
            'route' => $this->route,
        ];
    }
}
