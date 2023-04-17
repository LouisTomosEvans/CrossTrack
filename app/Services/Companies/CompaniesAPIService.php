<?php

namespace App\Services\Companies;
use GuzzleHttp\Client;

class CompaniesAPIService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.thecompaniesapi.com',
        ]);
    }

    public function getCompanyByDomain($domain, $additionalParams = [])
    {
        $apiKey = env('COMPANIESAPI_KEY');

        if(!empty($additionalParams)) {
            $additionalParams = http_build_query($additionalParams);
            $response = $this->client->get("/v1/companies/{$domain}?token={$apiKey}&{$additionalParams}");
        } else {
            $additionalParams = '';
            $response = $this->client->get("/v1/companies/{$domain}?token={$apiKey}");
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}