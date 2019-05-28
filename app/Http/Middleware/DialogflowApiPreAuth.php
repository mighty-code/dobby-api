<?php

namespace App\Http\Middleware;

use Closure;

class DialogflowApiPreAuth
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
        $agent = \Dialogflow\WebhookClient::fromData($request->json()->all());

        $originalRequest = $agent->getOriginalRequest();
        $userToken = array_get($originalRequest, 'payload.user.accessToken');

        if ($userToken) {
            $request->headers->add(['Authorization' => 'Bearer ' . $userToken]);
        }

        return $next($request);
    }
}
