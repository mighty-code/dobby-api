<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ConnectionService;
use Dialogflow\Action\Questions\Permission;
use Illuminate\Http\Request;

class DialogflowWebhooksController extends Controller
{
    public function webhooks(Request $request)
    {
        $user = auth()->user();

        $agent = \Dialogflow\WebhookClient::fromData($request->json()->all());

        $conv = $agent->getActionConversation();

        logger()->info('receiving indent from dialogflow: '.$agent->getIntent());

        $device = $conv->getDevice();
        if (! $device || ! $device->getLocation()) {
            $conv->ask(Permission::create('To address you by name and know your location', ['NAME', 'DEVICE_PRECISE_LOCATION']));
            $agent->reply($conv);
        } elseif ('Who am I?' == $agent->getIntent()) {
            $agent->reply("You're logged in as {$user->name}");
        } elseif ('Next Connection' == $agent->getIntent()) {
            $location = $device->getLocation()->getCoordinates();
            $message = $this->nextConnection($user, $location->getLatitude(), $location->getLongitude());
            $agent->reply($message);
        }

        return response()->json($agent->render());
    }

    public function nextConnection($user, $latitude, $longitude)
    {
        $connectionService = app(ConnectionService::class);
        $connection = $connectionService->getNextConnection($user, $latitude, $longitude);
        $leaveInMins = $connection->leaveInMinutes();

        return "Leave in {$leaveInMins} minutes to catch your next connection to {$connection->to}";
    }
}
