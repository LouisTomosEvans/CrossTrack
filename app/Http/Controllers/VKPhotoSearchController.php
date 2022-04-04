<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VKPhotoSearch;

class VKPhotoSearchController extends Controller
{
    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'lat' => ['required'],
            'lon' => ['required'],
            'url' => ['required', 'string'],
        ]);
        $user = Auth::user();
        $validatedRequest['user_id'] = $user->id;
        $VKPhotoSearch = VKPhotoSearch::create($validatedRequest);
        return $VKPhotoSearch;
    }
}
