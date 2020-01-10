<?php

namespace App\Services;

use GuzzleHttp\Client;

class ViadiClient
{
    const BASE_URL = 'http://free.viapi.ch/v1';

    public $client;

    /**
     * ViadiClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'headers' => ['API-Key' => config('services.viadi.api-key')],
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
    public function getConnections($from, $to, $via = null, $time)
    {
        $via = $via ? ['via' => $via] : null;

        $connections = json_decode($this->client->request('GET', ViadiClient::BASE_URL.'/connection', [
            'query' => [
                'from' => $from,
                'to'   => $to,
                'time' => $time,
                $via,
            ],
        ])->getBody())->connections;

        return collect($connections);
    }

    public function searchStation($query)
    {
        $stations = json_decode($this->client->request('GET', ViadiClient::BASE_URL.'/stations', [
            'query' => [
                'query' => $query,
            ],
        ])->getBody());

        return $stations;
    }
}
