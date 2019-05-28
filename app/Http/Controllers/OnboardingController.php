<?php

namespace App\Http\Controllers;

use App\Events\UpdateNextConnection;
use App\Http\Requests\StoreConnectionRequest;
use App\User;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    /**
     *
     * @param StoreConnectionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreConnectionRequest $request)
    {
        $connection = auth()->user()->connections()->create([
            'from'            => $request->from['name'],
            'to'              => $request->to['name'],
            'via'             => $request->via['name'],
            'station_id'      => $request->from['stationId'],
            'destination_id'  => $request->to['stationId'],
            'via_id'          => $request->via['stationId'],
            'time_to_station' => $request->time_to_station,
            'selected'        => true
        ]);

        event(new UpdateNextConnection($connection->id));

        $user = User::find(auth()->user()->id);
        $user->first_login = false;
        $user->save();


        return $connection;
    }
}
