<?php

namespace App\Listeners;

use App\Connection;
use App\Events\UpdateNextConnection;
use App\Services\ViadiClient;
use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Types\Point;

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
     * @param  UpdateNextConnection $event
     *
     * @return void
     */
    public function handle(UpdateNextConnection $event)
    {
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
        $connectionModel->from = $nextConnection->from->location->name;
        $connectionModel->from_location = new Point($nextConnection->from->location->latitude, $nextConnection->from->location->longitude);
        $connectionModel->to = $nextConnection->to->location->name;
        $connectionModel->to_location = new Point($nextConnection->to->location->latitude, $nextConnection->to->location->longitude);
        $connectionModel->save();

        $connectionModel->timetableEntries()->delete();
        foreach ($connections as $connection) {
            $this->saveTimetableEntries($connection, $connectionModel);
        }

    }

    public function saveTimetableEntries($connection, Connection $connectionModel)
    {
        $sections = collect($connection->sections)->filter(fn($section) => isset($section->route));
        $routes = $sections->map(fn($section) => $section->route);
        $route = $routes->map(fn($route) => $route->name);

        $timetableEntry = [
            'departure_from' => $connection->from->location->name,
            'departure_at_utc' => $connection->from->time / 1000,
            'departure_delay' => $connection->from->delay,
            'departure_platform' => data_get($connection, 'from.platform'),

            'arrival_to' => $connection->to->location->name,
            'arrival_at_utc' => $connection->to->time / 1000,
            'arrival_delay' => $connection->to->delay,
            'arrival_platform' =>  data_get($connection, 'to.platform'),

            'duration_minutes' => $this->duration($connection->duration),
            'route' => $route,
            'data' => $connection,
        ];

        $connectionModel->timetableEntries()->create($timetableEntry);
    }

    protected function duration($durationMs)
    {
        return $durationMs / 1000 / 60;
    }

    protected function time($timeToStation)
    {
        return Carbon::now()->addMinutes($timeToStation)->timestamp * 1000;
    }

}
