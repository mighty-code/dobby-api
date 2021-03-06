<?php

namespace App\Http\Resources;

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
        $data = parent::toArray($request);

        $nextConnection = $this->timetableEntries()->first();
        $data['departure'] = $nextConnection->departure_at_utc;
        $data['departure_delay'] = $nextConnection->departure_delay;
        $data['departure_platform'] = $nextConnection->departure_platform;

        $data['arrival'] = $nextConnection->arrival_at_utc;
        $data['arrival_delay'] = $nextConnection->arrival_delay;
        $data['arrival_platform'] = $nextConnection->arrival_platform;

        $data['duration'] = $nextConnection->duration_minutes;
        $data['route'] = $nextConnection->route;

        return $data;
    }
}
