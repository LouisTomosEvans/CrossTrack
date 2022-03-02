<?php

namespace App\Http\Controllers;

use App\Models\TwitterMedia;
use App\Models\TwitterSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwitterSearchController extends Controller
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
            'radius' => ['required'],
            'keywords' => ['string', 'nullable'],
            'question' => ['boolean'],
            'twitter_media_id' => ['string', 'nullable'],
            'min_likes' => ['integer'],
            'min_retweets' => ['integer'],
        ]);
        $user = Auth::user();
        if($validatedRequest['twitter_media_id'] ?? null){
            $media = TwitterMedia::where([['name', '=', $validatedRequest['twitter_media_id']]])->first();
            if($media){
                $validatedRequest['twitter_media_id'] = $media->id;
            }
        }
        $validatedRequest['user_id'] = $user->id;
        $twitterSearch = TwitterSearch::create($validatedRequest);
        return $twitterSearch;
    }
}
