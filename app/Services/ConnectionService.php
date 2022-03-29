<?php

namespace App\Services;

use App\Connection;
use App\Events\UpdateNextConnection;
use App\Models\User;

class ConnectionService
{
    public function getNextConnection(User $user, $lat = null, $lng = null)
    {
        if ($lat && $lng) {
            $connection = $this->getNearestConnection($user, $lat, $lng);
        } else {
            $connection = $this->getSelectedConnection($user);
        }

        return $this->refreshConnection($connection->id);
    }

    public function refreshConnection($id)
    {
        event(new UpdateNextConnection($id));

        return Connection::find($id);
    }

    private function getNearestConnection($user, $lat, $lng)
    {
        // sanitize params
        $lat = floatval($lat);
        $lng = floatval($lng);

        $point = "POINT({$lng} {$lat})";
        $connection = $user
            ->connections()
            ->selectRaw('*, ST_Distance(ST_GeomFromText(?), from_location) as dist', [$point])
            ->orderBy('dist')
            ->firstOrFail();

        return $connection;
    }

    private function getSelectedConnection($user)
    {
        return $user->connections()->whereSelected(true)->firstOrFail();
    }
}
