<?php

namespace App\Http\Controllers;

use App\Services\ViadiClient;
use Illuminate\Http\Request;

class StationSearchController extends Controller
{
    public function __invoke(Request $request, ViadiClient $viadiClient)
    {
        return $viadiClient->searchStation($request->get('query'));
    }
}
