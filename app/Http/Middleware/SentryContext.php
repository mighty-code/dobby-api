<?php

namespace App\Http\Middleware;

use Closure;
use Sentry\State\Scope;

class SentryContext
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
        $guards = config('auth.guards');
        $user = null;
        foreach ($guards as $guard => $config) {
            $user = auth()->user();
            if ($user) {
                break;
            }
        }

        if ($user && app()->bound('sentry')) {
            \Sentry\configureScope(function (Scope $scope) use ($user): void {
                $scope->setUser([
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                ]);
            });
        }

        return $next($request);
    }
}
