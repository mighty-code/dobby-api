<?php

namespace App\Http\Middleware;

use Closure;

class NotFirstLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! auth()->user()->first_login) {
            return $next($request);
        } else {
            return redirect()->route('onboarding');
        }
    }
}
