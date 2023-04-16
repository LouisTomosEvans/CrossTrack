<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segmentation;
use App\Models\User;
use App\Models\Website;



class SegmentationController extends Controller
{
    public function index()
    {
        // get all current team segments from the webiste_id where the website belongs to the team
        $segments = Segmentation::whereHas('website', function ($query) {
            $query->where('team_id', auth()->user()->currentTeam->id);
        })->get();
        // get website from the segment
        foreach ($segments as $segment) {
            $segment->website = $segment->website;
        }

        // get assigned users from the segment
        foreach ($segments as $segment) {
            $segment->users = $segment->users;
        }
        return $segments;
    }

    public function store(Request $request)
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'website' => 'required',
            'users' => 'required',
            'criterias' => 'required',
        ]);

        // check website is apart of the users current team
        $website = Website::find($validatedData['website']);
        $team = $request->user()->currentTeam;
        if (!$team->websites->contains($website)) {
            return ['error', 'Website not found in this team.'];
        }

        // Create the segment
        $segment = Segmentation::create([
            'name' => $validatedData['name'],
            'website_id' => $website->id,
            'criteria' => $validatedData['criterias'],
        ]);

        // attach semgento to users
        $users = $validatedData['users'];

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
        $segment->users()->attach($users);

        return ['success', 'Segment created successfully.'];
    }

    public function update(Request $request, $id)
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $validatedData = $request->validate([
            'segment' => 'required',
        ]);

        // get data from request
        $validatedData = $validatedData['segment'];

        // check segment is apart of the users current team
        $segment = Segmentation::find($id);
        $team = $request->user()->currentTeam;
        if (!$team->segments->contains($segment)) {
            return ['error', 'Segment not found in this team.'];
        }

        // check website is apart of the users current team
        $website = Website::find($validatedData['website']['id']);
        $team = $request->user()->currentTeam;
        if (!$team->websites->contains($website)) {
            return ['error', 'Website not found in this team.'];
        }

        // edit the segment
        $segment->name = $validatedData['name'];
        $segment->website_id = $website->id;
        $segment->criteria = $validatedData['criteria'];
        $segment->save();

        // detach all users from the segment
        $segment->users()->detach();

        // attach semgento to users
        $users = $validatedData['users'];


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
        $segment->users()->attach($users);

        return ['success', 'Segment edited successfully.'];
    }

    public function destroy($id)
    {
        // check user is apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        // check segment is apart of the users current team
        $segment = Segmentation::find($id);
        $team = auth()->user()->currentTeam;
        if (!$team->segments->contains($segment)) {
            return ['error', 'Segment not found in this team.'];
        }

        // delete the segment
        $segment->delete();

        return ['success', 'Segment deleted successfully.'];
    }

}
