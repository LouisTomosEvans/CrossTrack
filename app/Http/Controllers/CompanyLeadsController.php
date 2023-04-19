<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyLeadsController extends Controller
{
    // return all leads from all websites conntected to the team
    public function index($id)
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        // get current team id
        $id = auth()->user()->currentTeam->id;


        // get all leads for the current teams websites and leads
        $leads = \App\Models\CompanyLeads::whereHas('website', function ($query) use ($id) {
            $query->where('team_id', $id);
        })->get();

        //  for each lead get website name and visit count, unique visits based on visitor id, unique pages based on url, total duration of visits on the website, company lead location and company lead name
        foreach ($leads as $lead) {
            $lead->website_name = $lead->website->name;
            $lead->website_favicon = $lead->website->favicon;
            $lead->visit_count = $lead->visits->count();
            $lead->last_seen = $lead->visits->sortByDesc('timestamp')->first()->timestamp;
            $lead->location = $lead->city . ', ' . $lead->country;
            $lead->unique_visitors = $lead->visits->unique('visitor_id')->count();
            $lead->total_duration = $lead->visits->sum('session_duration');
            // rand score for now
            $lead->lead_score = rand(1, 100);
            // top pages visited
            $lead->top_pages = $lead->visits->groupBy('url')->map(function ($item) {
                return $item->count();
            })->sortDesc()->take(3)->toArray();
            // top sources
            $lead->top_sources = $lead->visits->groupBy('referrer')->map(function ($item) {
                return $item->count();
            })->sortDesc()->take(3)->toArray();

        }

        // return the leads
        return $leads;

    }
}
