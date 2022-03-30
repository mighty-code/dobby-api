<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConnectionTimetableResource;
use App\Http\Resources\NextConnectionResource;
use App\Services\ConnectionService;
use Illuminate\Http\Request;

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

        $nextConnection = $this->timetableEntries()->first();
        return NextConnectionResource::make($nextConnection);
    }

    public function timetable(ConnectionService $connectionService, Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;

        $connection = $connectionService->getNextConnection(auth()->user(), $lat, $lng);

        if (! $connection) {
            return null;
        }

        return ConnectionTimetableResource::make($connection);
    }
}
