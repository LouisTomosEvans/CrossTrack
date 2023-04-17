<?php

namespace App\Services\IPLookUp;
use GuzzleHttp\Client;

class IPRegistryService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.ipregistry.co/',
        ]);
    }

    public function getCompanyFromIP($ip, $additionalParams = [])
    {
        $apiKey = env('IPREGISTRY_API_KEY');
        if(!empty($additionalParams)) {
            $additionalParams = http_build_query($additionalParams);
            $response = $this->client->get("{$ip}&key={$apiKey}&{$additionalParams}");
        } else {
            $additionalParams = '';
            $response = $this->client->get("{$ip}&key={$apiKey}");
        }
        return json_decode($response->getBody()->getContents(), true);
    }
}