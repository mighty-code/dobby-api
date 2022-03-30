<?php

namespace App\Services;

use App\Events\UpdateNextConnection;
use App\Models\Connection;
use App\Models\User;

class ConnectionService
{
    public function getNextConnection(User $user, $lat = null, $lng = null): ?Connection
    {
        if ($lat && $lng) {
            $connection = $this->getNearestConnection($user, $lat, $lng);
        } else {
            $connection = $this->getSelectedConnection($user);
        }

        return $this->refreshConnection($connection->id);
    }

    public function refreshConnection($id): ?Connection
    {
        event(new UpdateNextConnection($id));

        return Connection::find($id);
    }

    private function getNearestConnection($user, $lat, $lng): Connection
    {
        // sanitize params
        $lat = (float) $lat;
        $lng = (float) $lng;

        $point = "POINT({$lng} {$lat})";
        $connection = $user
            ->connections()
            ->selectRaw('*, ST_Distance(ST_GeomFromText(?), from_location) as dist', [$point])
            ->orderBy('dist')
            ->firstOrFail();

        return $connection;
    }

    private function getSelectedConnection($user): Connection
    {
        return $user->connections()->whereSelected(true)->firstOrFail();
    }
}
