<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MetaPlaceSearch;

class MetaPlaceSearchController extends Controller
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
        ]);
        $user = Auth::user();
        $validatedRequest['user_id'] = $user->id;
        $MetaPlaceSearch = MetaPlaceSearch::create($validatedRequest);
        return $MetaPlaceSearch;
    }
}
