<?php

namespace App\Services\Contacts;
use GuzzleHttp\Client;

class FullContactService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.fullcontact.com/v3/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('FULLCONTACT_API_KEY'),
            ],
        ]);
    }

    public function getPersonInfoByEmail($email)
    {
        try {
            $response = $this->client->post('person.enrich', [
                'json' => [
                    'email' => $email,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return null;
        }
    }
}