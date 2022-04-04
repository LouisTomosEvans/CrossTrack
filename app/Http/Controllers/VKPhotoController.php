<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VKPhotoSearch;
use App\Models\VKPhoto;

class VKPhotoController extends Controller
{
    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'VKPhotoObjects' => ['required'],
            'VKPhotoSearch' => ['required'],
        ]);
        $user = Auth::user();
        $vkPhotoSearch = VKPhotoSearch::where([['id', ($validatedRequest['VKPhotoSearch']['id'])], ['user_id', $user->id]])->first();
        foreach ($validatedRequest['VKPhotoObjects'] as $photo){
            if(($photo['long'] ?? null) && ($photo['lat'] ?? null)){
                $photo['lon'] = $photo['long'];
                $vkPhoto = VKPhoto::create($photo);
                $vkPhoto->vkPhotoSearches()->attach($vkPhotoSearch);
            }
        }

        return;
    }
}
