<?php

namespace App\Http\Controllers;

use App\Connection;
use App\Events\UpdateNextConnection;
use App\Http\Requests\StoreConnectionRequest;
use App\Http\Resources\NextConnectionResource;
use App\Services\ConnectionService;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return NextConnectionResource::make($connection);
    }

    public function store(StoreConnectionRequest $request)
    {
        $connection = auth()->user()->connections()->create([
            'from'            => $request->input('from.name'),
            'from_location'   => $request->input('from.latitude')
                ? new Point($request->input('from.latitude'), $request->input('from.longitude'))
                : null,
            'to'              => $request->input('to.name'),
            'to_location'     => $request->input('to.latitude')
                ? new Point($request->input('to.latitude'), $request->input('to.longitude'))
                : null,
            'station_id'      => $request->input('from.stationId'),
            'destination_id'  => $request->input('to.stationId'),
            'time_to_station' => $request->input('time_to_station'),
        ]);

        event(new UpdateNextConnection($connection->id));

        return $connection;
    }

    public function makeDefault($id)
    {
        auth()->user()->connections()->update([
            'selected' => false
        ]);

        $connection = Connection::findOrFail($id);
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
