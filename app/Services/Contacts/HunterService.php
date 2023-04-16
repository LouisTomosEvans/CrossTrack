<?php

namespace App\Services\Contacts;
use GuzzleHttp\Client;

class HunterService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.hunter.io',
        ]);
    }

    public function getEmailsByDomain($domain, $additionalParams = [])
    {
        $apiKey = env('HUNTER_API_KEY');

        if(!empty($additionalParams)) {
            $additionalParams = http_build_query($additionalParams);
        } else {
            $additionalParams = '';
        }

        $response = $this->client->get("/v2/domain-search?domain={$domain}&api_key={$apiKey}&{$additionalParams}");

        return json_decode($response->getBody()->getContents(), true);
    }

    public function verifyEmail($email)
    {
        $apiKey = env('HUNTER_API_KEY');
        $response = $this->client->get("/v2/email-verifier?email={$email}&api_key={$apiKey}");

        return json_decode($response->getBody()->getContents(), true);
    }
}