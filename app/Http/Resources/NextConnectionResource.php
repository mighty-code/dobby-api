<?php

namespace App\Http\Resources;

use App\Models\TimetableEntry;
use Illuminate\Http\Resources\Json\JsonResource;

class NextConnectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        /** @var TimetableEntry $nextConnection */
        $nextConnection = $this->resource;

        $data = parent::toArray($request);

        $data['departure'] = $nextConnection->departure_at->toIso8601String();
        $data['departure_delay'] = $nextConnection->departure_delay;
        $data['departure_platform'] = $nextConnection->departure_platform;

        $data['arrival'] = $nextConnection->arrival_at->toIso8601String();
        $data['arrival_delay'] = $nextConnection->arrival_delay;
        $data['arrival_platform'] = $nextConnection->arrival_platform;

        $data['duration'] = $nextConnection->duration_minutes;
        $data['route'] = $nextConnection->route;

        return $data;
    }
}
