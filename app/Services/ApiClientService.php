<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClientService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('api.spring.api_url'),
            'headers' => [
                'Authorization' => 'Bearer ' . config('api.spring.token'),
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * @throws Exception
     */
    public function fetchData(string $endpoint, array $params = [])
    {
        try {
            $response = $this->client->get($endpoint, [
                'query' => $params,
                'timeout' => config('api.spring.timeout'),
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new Exception("API Error: " . $e->getMessage(), $e->getCode());
        }
    }
}
