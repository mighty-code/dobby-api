<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ViadiClient
{
    public const BASE_URL = 'http://free.viapi.ch/v1';

    public PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::withHeaders([
            'API-Key' => config('services.viadi.api-key'),
        ]);
    }

    /**
     * @param      $from
     * @param      $to
     * @param null $via
     * @param      $time
     *
     * @return \Illuminate\Support\Collection
     */
    public function getConnections($from, $to, $via, $time)
    {
        $via = $via ? ['via' => $via] : [];

        $response = $this->client->get(ViadiClient::BASE_URL.'/connection', [
            'from' => $from,
            'to' => $to,
            'time' => $time,
            ...$via,
        ])
            ->throw()
            ->json();

        return collect($response['connections']);
    }

    public function searchStation($query)
    {
        $stations = $this->client->get(ViadiClient::BASE_URL.'/stations', [
            'query' => $query,
        ])
            ->throw()
            ->json();

        return $stations;
    }
}
