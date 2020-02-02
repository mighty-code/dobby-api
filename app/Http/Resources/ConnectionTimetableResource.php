<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConnectionTimetableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from' => $this->from,
            'from_location' => $this->from_location,
            'station_id' => $this->station_id,
            'to' => $this->to,
            'to_location' => $this->to_location,
            'destination_id' => $this->destination_id,
            'via' => $this->via,
            'via_id' => $this->via_id,
            'time_to_station' => $this->time_to_station,
            'selected' => $this->selected,
            'timetable' => TimetableResource::collection($this->whenLoaded('timetableEntries')),
        ];
    }
}
