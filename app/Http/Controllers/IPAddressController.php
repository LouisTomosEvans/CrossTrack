<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\IPAddress;

class IPAddressController extends Controller
{
    public function index($id){
        $user = Auth::user();
        return json_encode(IPAddress::where([['id', $id], ['user_id', $user->id]])->first());
    }
    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'IPAddresses' => ['required'],
        ]);
        $endpoint = 'http://ip-api.com/batch?fields=17035263';
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($validatedRequest['IPAddresses'])
            ]
        ];
        $response = file_get_contents($endpoint, false, stream_context_create($options));
        $response = json_decode($response);
        $user = Auth::user();
        $dataReturn = [];
        foreach($response as $IPResult){
            $IPResult->user_id = $user->id;
            $IPObject = IPAddress::create((array) $IPResult);
            $IPObjectData = (object)[];
            $IPObjectData->lat = $IPObject['lat'];
            $IPObjectData->lon = $IPObject['lon'];
            $IPObjectData->id = $IPObject['id'];
            $dataReturn[] = $IPObjectData;
        }
        return json_encode($dataReturn);

    }
}
