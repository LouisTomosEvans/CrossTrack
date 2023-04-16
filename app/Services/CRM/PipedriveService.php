<?php

namespace App\Services\CRM;

use Devio\Pipedrive\Pipedrive;

class PipedriveService
{
    protected $client;

    public function __construct($apiKey)
    {
        $this->client = new Pipedrive($apiKey);
    }

    public function createLead($leadData)
    {
        $response = $this->client->persons()->add($leadData);
        return $response;
    }
}
