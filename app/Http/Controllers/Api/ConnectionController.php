<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConnectionTimetableResource;
use App\Http\Resources\NextConnectionResource;
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

        return NextConnectionResource::make($connection);
    }
}
