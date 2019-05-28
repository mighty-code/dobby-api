<?php

namespace App\Http\Controllers;

use App\Events\UpdateNextConnection;
use App\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreConnectionRequest;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use App\Services\ConnectionService;

class ConnectionController extends Controller
{
    public function nextConnection(ConnectionService $connectionService, Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $connection = $connectionService->getNextConnection(auth()->user(), $lat, $lng);

        if (! $connection) {
            return null;
        }

        return $connection;
    }

    public function store(StoreConnectionRequest $request)
    {
        $connection = auth()->user()->connections()->create([
            'from'            => $request->from['name'],
            'from_location'   => new Point($request->from['latitude'], $request->from['longitude']),
            'to'              => $request->to['name'],
            'to_location'     => new Point($request->to['latitude'], $request->to['longitude']),
            'via'             => $request->via['name'],
            'station_id'      => $request->from['stationId'],
            'destination_id'  => $request->to['stationId'],
            'via_id'          => $request->via['stationId'],
            'time_to_station' => $request->time_to_station,
        ]);

        event(new UpdateNextConnection($connection->id));

        return $connection;
    }

    public function makeDefault($id)
    {
        auth()->user()->connections()->get()->map(function ($connection) {
            $connection->selected = false;
            $connection->save();
        });

        $connection = Connection::find($id);
        $connection->selected = true;
        $connection->save();
    }

    public function myConnections()
    {
        return auth()->user()->connections()->orderBy('created_at', 'desc')->get();
    }

    public function delete($id)
    {
        auth()->user()->connections()->whereId($id)->delete();
    }
}
