<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MetaPlaceSearch;
use App\Models\MetaPlace;


class MetaPlaceController extends Controller
{
    public function index()
    {

    }

    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'placeObjects' => ['required'],
            'metaPlaceSearch' => ['required'],
        ]);
        $user = Auth::user();
        $metaPlaceSearch = MetaPlaceSearch::where([['id', ($validatedRequest['metaPlaceSearch']['id'])], ['user_id', $user->id]])->first();
        foreach ($validatedRequest['placeObjects'] as $place){
            if(($photo['lng'] ?? null) && ($photo['lat'] ?? null)){
                $place['lon'] = $place['lng'];
                $metaPlace = MetaPlace::create($place);
                $metaPlace->metaPlaceSearches()->attach($metaPlaceSearch);
            }
        }

        return;
    }
}
