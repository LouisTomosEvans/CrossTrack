<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class IPAddressController extends Controller
{
    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'IPAddresses' => ['required'],
        ]);
        $user = Auth::user();
        $client = new Client(['base_uri' => 'http://ip-api.com/batch', 'Content-Type:' => 'application/json']);
        $data = $validatedRequest['IPAddresses'];
        $response = $client->request('POST', json_encode($data));
        dd($response->getBody()->getContents());
        return;
    }
}
