<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spark\Spark;
use Spark\Plan;

class AppController extends Controller
{
    //
    /**
     * Show the dashboard for a given user.
     *
     *
     */

    public function index()
    {
        $user = Auth::user();
        if($user->subscribed()){
            $plan = $user->sparkPlan()->name;
            return [$user->name, $plan];
        }
        return $user;
    }
}
