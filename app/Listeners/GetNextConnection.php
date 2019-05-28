<?php

namespace App\Listeners;

use App\Events\UpdateNextConnection;
use Carbon\Carbon;

use App\Connection;
use App\Services\ViadiClient;
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
        $connection = Connection::find($event->id);

        $leaveIn = $connection->leaveInMinutes();

        if ($leaveIn > 0) {
            return;
        }

        $nextConnection = $this->viadiClient->getConnections(
            $connection->station_id,
            $connection->destination_id,
            $connection->via,
            $this->time($connection->time_to_station + 1)
        )
            ->first();

        // Update connection with the latest infos
        $connection->from = $nextConnection->from->location->name;
        $connection->from_location = new Point($nextConnection->from->location->latitude, $nextConnection->from->location->longitude);
        $connection->to = $nextConnection->to->location->name;
        $connection->to_location = new Point($nextConnection->to->location->latitude, $nextConnection->to->location->longitude);
        $connection->departure_platform = isset($nextConnection->from->platform)
            ? $nextConnection->from->platform
            : null;
        $connection->departure = $nextConnection->from->time / 1000;
        $connection->arrival = $nextConnection->to->time / 1000;
        $connection->duration = $nextConnection->duration / 1000;
        $connection->save();
    }

    public function time($timeToStation)
    {
        return Carbon::now()->addMinutes($timeToStation)->timestamp * 1000;
    }
}
