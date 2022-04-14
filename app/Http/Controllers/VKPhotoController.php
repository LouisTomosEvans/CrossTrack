<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VKPhotoSearch;
use App\Models\VKPhoto;

class VKPhotoController extends Controller
{
    public function index($id){
        return json_encode(VKPhoto::find($id));
    }
    public function create(Request $request)
    {
        $validatedRequest = $request->validate([
            'VKPhotoObjects' => ['required'],
            'VKPhotoSearch' => ['required'],
        ]);
        $vkPhotoDataReturn = [];
        $user = Auth::user();
        $vkPhotoSearch = VKPhotoSearch::where([['id', ($validatedRequest['VKPhotoSearch']['id'])], ['user_id', $user->id]])->first();
        foreach ($validatedRequest['VKPhotoObjects'] as $photo){
            if(($photo['long'] ?? null) && ($photo['lat'] ?? null)){
                $photo['lon'] = round($photo['long'], 6);
                $photo['lat'] = round($photo['lat'], 6);
                $vkPhoto = null;
                $vkPhoto = VKPhoto::where([['photo_id', ($photo['id'])]])->where([['lat', ($photo['lat'])]])->where([['lon', ($photo['lon'])]])->first();
                if(!$vkPhoto){
                    $photo['photo_id'] = $photo['id'];
                    if($photo['sizes']){
                        $photo['preview_URL'] = (end($photo['sizes'])['url']);
                    }
                    $vkPhoto = VKPhoto::create($photo);
                }
                $vkPhoto->vkPhotoSearches()->attach($vkPhotoSearch);
                $photoObject = (object)[];
                $photoObject->lat = $vkPhoto['lat'];
                $photoObject->lon = $vkPhoto['lon'];
                $photoObject->id = $vkPhoto['id'];
                $vkPhotoDataReturn[] = $photoObject;
            }
        }
        if($vkPhotoDataReturn){
            return json_encode($vkPhotoDataReturn);
        }
        return;
    }
}
