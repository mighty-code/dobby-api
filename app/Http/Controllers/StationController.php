<?php

namespace App\Http\Controllers;

use App\Services\ViadiClient;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function search(Request $request, ViadiClient $viadiClient)
    {
        return $viadiClient->searchStation($request->get('query'));
    }
}
