<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Team;

class WebsiteController extends Controller
{
    
    // get all websites for the current team
    public function index()
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }
        $websites = auth()->user()->currentTeam->websites;
        return $websites;
    }

    // create a new website
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        // generate a tracking code for tracking js
        $request->merge([
            'tracking_code' => md5(uniqid(rand(), true)),
        ]);

        // team id is the current team
        $request->merge([
            'team_id' => auth()->user()->currentTeam->id,
        ]);

        $website = auth()->user()->currentTeam->websites()->create([
            'name' => $request->name,
            'tracking_code' => $request->tracking_code,
            'tracking_status' => 0,
        ]);

        return json_encode(['success' => true]);
    }

    // update a website
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $website = auth()->user()->currentTeam->websites()->findOrFail($id);
        $website->update([
            'name' => $request->name,
        ]);

        return json_encode(['success' => true]);
    }

    // delete a website
    public function destroy($id)
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $website = auth()->user()->currentTeam->websites()->findOrFail($id);
        $website->delete();

        return json_encode(['success' => true]);
    }

    //  update team status
    public function updateStatus(Request $request, $id, $website_id)
    {

        // get team
        $team = Team::findOrFail($id);

        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam($team)) {
            abort(403);
        }

        $website = auth()->user()->currentTeam->websites()->findOrFail($website_id);
        $website->update([
            'active' => $website->active ? 0 : 1,
        ]);

        return json_encode(['success' => true]);
    }
}

