<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyLeads;
use App\Models\Visits;
use App\Models\Team;
// use date time
use DateTime;
// use carbon
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index($team_id)
    {
        // parse data to send to frontend
        return json_encode($dashboardData);
    }
}
