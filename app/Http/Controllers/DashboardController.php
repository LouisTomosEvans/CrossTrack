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
        // get this team
        $team = Team::find($team_id);

        // check user is apart of team
        if (auth()->user()->currentTeam->id != $team->id) {
            return abort(403, 'You are not authorized to view this page.');
        }

        $leads = CompanyLeads::whereHas('website', function ($query) use ($team_id) {$query->where('team_id', $team_id);})->get();

        // get all visits for this team, visits have company lead id and get website id from company lead
        $visits = Visits::whereHas('companyLeads', function ($query) use ($team_id) {
            $query->whereHas('website', function ($query) use ($team_id) {
                $query->where('team_id', $team_id);
            });
        })->get();

        // get all the data for the dashboard
        $data = [
            // get all leads for the current teams websites and leads
            'leads' => $leads,
            // get all visits for this team
            'visits' => $visits,

        ];

        // collect all the data for the dashboard
        $dashboardData = [];
        // get new leads this month
        $dashboardData['new_leads_this_month'] = $data['leads']->where('created_at', '>=', now()->startOfMonth())->count();

        // get unique visitors this month
        $dashboardData['unique_visitors_this_month'] = $data['visits']->where('timestamp', '>=', now()->startOfMonth())->unique('visitor_id')->count();

        // get returning leads this month - leads that have visits this month and existed last month
        $dashboardData['returning_leads_this_month'] = $data['leads']->where('created_at', '<=', now()->subMonth()->endOfMonth())->filter(function ($lead) use ($data) {
            return $data['visits']->where('company_leads_id', $lead->id)->where('timestamp', '>=', now()->startOfMonth())->count() > 0;
        })->count();
        


        // get graph data for visits and company leads this month
        $dashboardData['visits_this_month'] = $data['visits']->where('timestamp', '>=', now()->startOfMonth())->groupBy(function ($item) {
            // convert time stamp to date type
            return \Carbon\Carbon::parse($item->timestamp)->format('d');
        })->map(function ($item) {
            return $item->count();
        })->toArray();

        $dashboardData['leads_this_month'] = $data['leads']->where('created_at', '>=', now()->startOfMonth())->groupBy(function ($item) {
            return $item->created_at->format('d');
        })->map(function ($item) {
            return $item->count();
        })->toArray();

        // returning leads this month
        $dashboardData['returning_leads_this_month_data'] = $data['leads']->where('created_at', '<=', now()->subMonth()->endOfMonth())->filter(function ($lead) use ($data) {
            return $data['visits']->where('company_leads_id', $lead->id)->where('timestamp', '>=', now()->startOfMonth())->count() > 0;
        })->groupBy(function ($item) {
            // convert timestamp to date type
            $timestamp = $item->visits->where('timestamp', '>=', now()->startOfMonth())->sortBy('timestamp')->first()->timestamp;
            $timestamp = \Carbon\Carbon::parse($timestamp)->format('d');
            return $timestamp;
        })->map(function ($item) {
            return $item->count();
        })->toArray();

        // get top leads this month return 5 based on lead score
        $dashboardData['top_leads_this_month'] = $data['leads']->where('created_at', '>=', now()->startOfMonth())->sortByDesc('lead_score')->take(5);

        // get top lead countries this month return 5 based on frequency of visits
        $dashboardData['top_lead_countries_this_month'] = $data['leads']->where('created_at', '>=', now()->startOfMonth())->groupBy('country')->map(function ($item) {
            return $item->count();
        })->sortDesc()->take(5)->toArray();

        // get a break down of refferers this month based on unique visitors
        $dashboardData['top_referrers_this_month'] = $data['visits']->where('timestamp', '>=', now()->startOfMonth())->groupBy('referrer')->map(function ($item) {
            return $item->unique('visitor_id')->count();
        })->sortDesc()->toArray();

        // go through top 5 refferers and get the frequency of unique visitors per day this month
        $dashboardData['top_referrers_this_month_data'] = [];
        foreach ($dashboardData['top_referrers_this_month'] as $key => $value) {
            $dashboardData['top_referrers_this_month_data'][$key] = $data['visits']->where('timestamp', '>=', now()->startOfMonth())->where('referrer', $key)->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->timestamp)->format('d');
            })->map(function ($item) {
                return $item->unique('visitor_id')->count();
            })->toArray();
        }

        $now = new DateTime();
        $daysInMonth = (int)$now->format('j');
        $visits_this_month = array_fill(0, $daysInMonth, 0);
        $leads_this_month = array_fill(0, $daysInMonth, 0);
        $returning_leads_this_month = array_fill(0, $daysInMonth, 0);
        $labels = [];

        for ($i = 0; $i < $daysInMonth; $i++) {
            $labels[] = ($now->format('n') . '/' . ($i + 1) . '/' . $now->format('Y'));
            $day = $i + 1;

            // check it's not 09 or 08 etc
            if (strlen($day) == 1) {
                $day = '0' . $day;
            }
        
            if (isset($dashboardData['visits_this_month'][$day])) {
                $visits_this_month[$i] = $dashboardData['visits_this_month'][$day];
            }
        
            if (isset($dashboardData['leads_this_month'][$day])) {
                $leads_this_month[$i] = $dashboardData['leads_this_month'][$day];
            }
        
            if (isset($dashboardData['returning_leads_this_month_data'][$day])) {
                $returning_leads_this_month[$i] = $dashboardData['returning_leads_this_month_data'][$day];
            }
        }

        $referrerData = [];
        foreach ($dashboardData['top_referrers_this_month_data'] as $referrer => $refData) {
            $newRefData = array_fill(0, $daysInMonth, 0);
            foreach ($refData as $day => $count) {
                $newRefData[$day - 1] = $count;
            }
            $referrerData[$referrer] = [
                'name' => $referrer,
                'data' => $newRefData
            ];
        }
        // unset top referrers this month 
        unset($dashboardData['top_referrers_this_month']);
        $top_referrers_this_month = array_values($referrerData);
        $dashboardData['top_referrers_this_month_data'] = $top_referrers_this_month;
        $dashboardData['returning_leads_this_month_data'] = $returning_leads_this_month;
        $dashboardData['leads_this_month'] = $leads_this_month;
        $dashboardData['visits_this_month'] = $visits_this_month;
        $dashboardData['labels'] = $labels;



        return json_encode($dashboardData);
    }
}
