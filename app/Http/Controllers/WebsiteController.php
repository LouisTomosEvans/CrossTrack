<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Team;
use AshAllenDesign\FaviconFetcher\Facades\Favicon;

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
            'domain' => 'required',
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

        // get the favicon
        $faviconPath = Favicon::fetch('https://' . $request->domain)->store('public/favicons');


        $website = auth()->user()->currentTeam->websites()->create([
            'name' => $request->name,
            'domain' => $request->domain,
            'favicon' => $faviconPath,
            'tracking_code' => $request->tracking_code,
            'tracking_status' => 0,
        ]);

        // get the tracking snippet
        $trackingSnippet = "<script async src=\"https://app.leadrhino.io/tracking/{tracking-code}\"></script>";
        $trackingSnippet = str_replace('{tracking-code}', $website->tracking_code, $trackingSnippet);

        return json_encode(['success' => true, 'trackingSnippet' => $trackingSnippet]);
    }

    // update a website
    public function update(Request $request, $id, $website_id)
    {
        $request->validate([
            'name' => 'required',
            'domain' => 'required',
        ]);

        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $website = auth()->user()->currentTeam->websites()->findOrFail($website_id);

        // if domain has changed
        if ($request->domain != $website->domain) {
            // get the favicon
            $faviconPath = Favicon::fetch('https://' . $request->domain)->store('public/favicons');
        } else {
            $faviconPath = $website->favicon;
        }

        $website->update([
            'name' => $request->name,
            'domain' => $request->domain,
            'favicon' => $faviconPath,
        ]);

        return json_encode(['success' => true]);
    }

    // delete a website
    public function destroy($id, $website_id)
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $website = auth()->user()->currentTeam->websites()->findOrFail($website_id);
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

    // get website tracking snippet
    public function trackingSnippet($id, $website_id)
    {
        // get team
        $team = Team::findOrFail($id);

        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam($team)) {
            abort(403);
        }

        $website = auth()->user()->currentTeam->websites()->findOrFail($website_id);

        // get the tracking snippet
        $trackingSnippet = "<script async src=\"https://app.leadrhino.io/tracking/{tracking-code}\"></script>";

        $trackingSnippet = str_replace("{tracking-code}", $website->tracking_code, $trackingSnippet);

        return JSON_encode([
            'trackingSnippet' => $trackingSnippet,
        ]);

    }

}

