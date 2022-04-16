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
        $plan = null;
        $user = Auth::user();
        if($user->subscribed()){
            $plan = $user->sparkPlan()->name;
        }
        if ($plan == null) {
            $plan = 'Free Trial';
        }
        return [$user->name, $plan];
    }
    public function plan()
    {
        $user = Auth::user();
        $plan = null;
        if($user->subscribed()){
            $plan = $user->sparkPlan()->name;
            $endDate = null;
        }
        if ($plan == null) {
            $plan = 'Free Trial';
            $endDate = $user->trial_ends_at;
        }
        return [$plan, $endDate];
    }
}
