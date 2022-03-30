<?php

namespace App\Listeners;

use App\Events\UpdateNextConnection;
use App\Models\Connection;
use App\Services\ViadiClient;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use MatanYadaev\EloquentSpatial\Objects\Point;

class GetNextConnection
{
    public $viadiClient;

    /**
     * Create the event listener.
     *
     * @param ViadiClient $viadiClient
     */
    public function __construct(ViadiClient $viadiClient)
    {
        $this->viadiClient = $viadiClient;
    }

    /**
     * Handle the event.
     *
     * @param UpdateNextConnection $event
     *
     * @return void
     */
    public function handle(UpdateNextConnection $event)
    {
        /** @var Connection $connectionModel */
        $connectionModel = Connection::find($event->id);

        $leaveIn = $connectionModel->leaveInMinutes();

        if ($leaveIn > 0) {
            return;
        }

        $connections = $this->viadiClient->getConnections(
            $connectionModel->station_id,
            $connectionModel->destination_id,
            $connectionModel->via,
            $this->time($connectionModel->time_to_station + 1)
        );

        // Update connection with the latest infos
        $nextConnection = $connections->first();
        $connectionModel->from = Arr::get($nextConnection, 'from.location.name');
        $connectionModel->from_location = new Point(Arr::get($nextConnection, 'from.location.latitude'), Arr::get($nextConnection, 'from.location.longitude'));
        $connectionModel->to = Arr::get($nextConnection, 'to.location.name');
        $connectionModel->to_location = new Point(Arr::get($nextConnection, 'to.location.latitude'), Arr::get($nextConnection, 'to.location.longitude'));
        $connectionModel->save();

        $connectionModel->timetableEntries()->delete();
        foreach ($connections as $connection) {
            $this->saveTimetableEntries($connection, $connectionModel);
        }
    }

    public function saveTimetableEntries($connection, Connection $connectionModel)
    {
        $route = collect($connection['sections'])
            ->filter(fn($section) => isset($section['route']))
            ->map(fn($section) => $section['route'])
            ->map(fn($route) => $route['name']);

        $timetableEntry = [
            'departure_from' => Arr::get($connection, 'from.location.name'),
            'departure_at' => Carbon::createFromTimestampUTC(Arr::get($connection, 'from.time') / 1000),
            'departure_delay' => Arr::get($connection, 'from.delay'),
            'departure_platform' => Arr::get($connection, 'from.platform'),

            'arrival_to' => Arr::get($connection, 'to.location.name'),
            'arrival_at' => Carbon::createFromTimestampUTC(Arr::get($connection, 'to.time') / 1000),
            'arrival_delay' => Arr::get($connection, 'to.delay'),
            'arrival_platform' => Arr::get($connection, 'to.platform'),

            'duration_minutes' => $this->duration($connection['duration']),
            'route' => $route,
            'data' => $connection,
        ];

        $connectionModel->timetableEntries()->create($timetableEntry);
    }

    protected function duration($durationMs): float|int
    {
        return $durationMs / 1000 / 60;
    }

    protected function time($timeToStation): float|int
    {
        return Carbon::now()->addMinutes($timeToStation)->timestamp * 1000;
    }
}
