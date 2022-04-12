<?php

namespace App\Http\Controllers;

use App\Models\MapSearch;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Test
use GuzzleHttp\Client;

class MapSearchController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'lat' => ['required'],
            'lon' => ['required'],
            'url' => ['required', 'string'],
            'website_id' => ['required', 'string']
        ]);

        $user = Auth::user();
        $website = Website::where([['name', '=', $validatedRequest['website_id']]])->first();

        if($website){
            $validatedRequest['website_id'] = $website->id;
            $validatedRequest['user_id'] = $user->id;
            $mapSearch = MapSearch::create($validatedRequest);
            return $mapSearch;
        } else {
            abort(422);
        }
    }

    public function test(Request $request)
    {
        $validatedRequest = $request->validate([
            'username' => ['required'],
        ]);

        $client = new Client([
            'base_uri' => 'https://www.pinterest.com/', 'http_errors' => false
        ]);
        
        $response = $client->request('GET', $validatedRequest['username']);
        dd($response->getStatusCode());
    }
}
