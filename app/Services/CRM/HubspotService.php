<?php

namespace App\Services\CRM;
use HubSpot\Factory;

class HubSpotService
{
    protected $client;

    public function __construct($apiKey)
    {
        $this->client = Factory::createWithApiKey($apiKey);
    }

    public function createLead($leadData)
    {
        $response = $this->client->crm()->contacts()->basicApi()->create($leadData);
        return $response;
    }
}
