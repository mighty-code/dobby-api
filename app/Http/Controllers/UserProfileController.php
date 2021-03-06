<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserProfileResource;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return UserProfileResource::make($request->user());
    }
}
