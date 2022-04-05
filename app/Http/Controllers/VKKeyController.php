<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VKKey;
use Illuminate\Support\Facades\Auth;

class VKKeyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $VKKey = VKKey::where('user_id', $user->id)->first();
        if($VKKey){
            return $VKKey->key;
        } else {
            return;
        }
    }

    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'key' => ['required']
        ]);
        $user = Auth::user();
        $VKKey = VKKey::where('user_id', $user->id)->first();
        if($VKKey){
            $VKKey->key = $validatedRequest['key'];
            $VKKey->save();
        } else {
            $validatedRequest['user_id'] = $user->id;
            $VKKey = VKKey::create($validatedRequest);
        }
        return;
    }
}
