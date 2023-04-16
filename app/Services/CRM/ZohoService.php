<?php

namespace App\Services\CRM;

use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

class ZohoService
{
    protected $client;

    public function __construct()
    {
        $oAuthClient = ZohoOAuth::getClientInstance();
        $accessToken = $oAuthClient->getAccessToken(ZCRMRestClient::getOrgID());
        ZCRMRestClient::initialize();
    }

    public function createLead($leadData)
    {
        $record = ZCRMRecord::getInstance("Leads", null);
        foreach ($leadData as $key => $value) {
            $record->setFieldValue($key, $value);
        }
        $response = $record->create();
        return $response;
    }
}