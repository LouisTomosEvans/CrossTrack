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

        $teams = $user->teams;
        $currentTeam = $user->currentTeam;

        return [$user, $currentTeam->id, $teams];
    }
}
