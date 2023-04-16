<?php

namespace App\Services\CRM;
use Forrest;

class SalesforceService
{
    public function __construct()
    {
        Forrest::authenticate();
    }

    public function createLead($leadData)
    {
        $response = Forrest::sobjects('Lead', [
            'method' => 'post',
            'body' => $leadData,
        ]);

        return $response;
    }
}
