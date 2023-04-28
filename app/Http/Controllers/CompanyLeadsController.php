<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visits;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyLeads;
use App\Models\User;
use Spatie\Tags\Tag; // Import the correct Tag model from the package

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
            $lead->website_domain = $lead->website->domain;
            //  get number of sessions, a session is a visit by a user that last 30 minutes, after 30 mins its a new session
            $lead->sessions = $lead->visits->groupBy('visitor_id')->count();
            $lead->last_seen = $lead->visits->sortByDesc('timestamp')->first()->timestamp;
            $lead->location = $lead->city . ', ' . $lead->country;
            $lead->unique_visitors = $lead->visits->unique('visitor_id')->count();
            $lead->total_duration = $lead->visits->sum('session_duration');
            // if ($lead->leadScore){
            //     $lead->lead_score = $lead->leadScore->score;
            // } else {
            //     $lead->lead_score = 0;
            // }
            // top pages visited
            $lead->top_pages = $lead->visits->groupBy('url')->map(function ($item) {
                return $item->count();
            })->sortDesc()->take(3)->toArray();
            // top sources
            $lead->top_sources = $lead->visits->groupBy('referrer')->map(function ($item) {
                return $item->count();
            })->sortDesc()->take(3)->toArray();

            $lead->users = $lead->users->map(function ($user) {
                $user->name = $user->name;
                return $user;
            });

            $sessionTimeout = 30;
            $sessionTimeoutSeconds = $sessionTimeout * 60;

            $rawQuery = "SELECT COUNT(*) as session_count
                        FROM (
                            SELECT visitor_id, timestamp,
                                LAG(timestamp) OVER (PARTITION BY visitor_id ORDER BY timestamp) as prev_timestamp
                            FROM visits
                            WHERE company_leads_id = ?
                        ) AS subquery
                        WHERE (TIMESTAMPDIFF(MINUTE, subquery.timestamp, subquery.prev_timestamp) > ?) OR (subquery.prev_timestamp IS NULL)";

            $lead->visit_count = DB::selectOne($rawQuery, [$lead->id, $sessionTimeoutSeconds])->session_count;

            // lead with tags
            $lead->tags = $lead->tags->map(function ($tag) {
                $tag->name = $tag->name;
                return $tag;
            });

        }

        // return the leads
        return $leads;

    }
    public function update(Request $request, $id)
    {
         // check user is apart of team
         if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $validatedData = $request->validate([
            'lead' => 'required',
        ]);

        // get data from request
        $validatedData = $validatedData['lead'];

        // check lead is apart of the users current team
        $lead = CompanyLeads::find($id);
        $team = $request->user()->currentTeam;
        if (!$team->companyLeads->contains($lead)) {
            return ['error', 'Lead not found in this team.'];
        }

        // detach all users from the segment
        $lead->users()->detach();

        // attach semgento to users
        $users = $validatedData['users'];
        $tags = $validatedData['tags'];


        // pick id from users array
        $users = array_map(function ($user) {
            return $user['id'];
        }, $users);

        // get the users from the request
        $users = User::whereIn('id', $users)->get();
        // check users id are apart of the users current team
        foreach ($users as $user) {
            if (!$team->users->contains($user)) {
                return ['error', 'User not found in this team.'];
            }
        }
        $lead->users()->attach($users);
        
        // detach all tags from the lead
        $lead->detachTags($lead->tags);

        // update tags
        foreach ($tags as $tag) {
            // Find or create the tag with the specified name and color
            if(isset($tag['text'])){
                        
                
                
                $tagMod = Tag::findOrCreate($tag['text'], 'default');

                // If a color is provided, update the tag's color
                if (isset($tag['color'])) {
                    $tagMod->color = $tag['color'];
                    $tagMod->save();
                }

                // Attach the tag to the CompanyLead instance
                $lead->attachTag($tagMod);
            } else if (isset($tag['id'])) {
                $tagMod = Tag::find($tag['id']);
                $lead->attachTag($tagMod);
            }
        }


        return ['success', 'Lead edited successfully.'];
    }
}
