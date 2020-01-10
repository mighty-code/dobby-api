<?php

namespace App\Http\Controllers;

use App\Events\UpdateNextConnection;
use App\Http\Requests\StoreConnectionRequest;
use App\User;
use Auth;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function __invoke(StoreConnectionRequest $request)
    {
        $connection = Auth::user()->connections()->create([
            'from' => $request->input('from.name'),
            'station_id' => $request->input('from.stationId'),
            'from_location' => new Point($request->input('from.latitude'), $request->input('from.longitude')),

            'to' => $request->input('to.name'),
            'destination_id' => $request->input('to.stationId'),
            'to_location' =>  new Point($request->input('to.latitude'), $request->input('to.longitude')),

            'time_to_station' => $request->time_to_station,
            'selected' => true,
        ]);

        event(new UpdateNextConnection($connection->id));

        $user = User::find(auth()->user()->id);
        $user->first_login = false;
        $user->save();

        return $connection;
    }
}
