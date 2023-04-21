<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->teams;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // check user isn't an owner of a team
        if (auth()->user()->ownedTeams()->count() > 0) {
            abort(403, 'You are already an owner of a team. We only allow one team per user. If you want to create a new team, please delete your existing team first.');
        }

        // create team
        // Check user is not already in a team with the same name
        if (Team::where('name', $request->name)->whereHas('users', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->exists()) {
            abort(403, 'You are already in a team with that name');
        }

        $team = Team::create([
            'name' => $request->name,
            'owner_id' => $request->user()->getKey(),
        ]);
        $request->user()->attachTeam($team);

        // return success
        return $team;
    }

    public function storeBlocked(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // check user isn't an owner of a team
        if (auth()->user()->ownedTeams()->count() > 0) {
            abort(403, 'You are already an owner of a team. We only allow one team per user. If you want to create a new team, please delete your existing team first.');
        }

        // create team
        // Check user is not already in a team with the same name
        if (Team::where('name', $request->name)->whereHas('users', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->exists()) {
            abort(403, 'You are already in a team with that name');
        }

        $team = Team::create([
            'name' => $request->name,
            'owner_id' => $request->user()->getKey(),
        ]);
        $request->user()->attachTeam($team);

        // return to dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Switch to the given team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchTeam($id)
    {
        $team = Team::findOrFail($id);
        try {
            auth()->user()->switchTeam($team);
        } catch (UserNotInTeamException $e) {
            abort(403);
        }

        return $team;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);

        if (! auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        return $team;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // get team
        $team = Team::findOrFail($id);

        // check is owner
        if (! auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        // update team
        // Check user is not already in a team with the same name
        if (Team::where('name', $request->name)->whereHas('users', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->exists()) {
            abort(403, 'You are already in a team with that name');
        }

        // check this user is the owner of the team
        $team = Team::findOrFail($id);
        if (! auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $team->name = $request->name;
        $team->save();

        return $team;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($id);
        if (! auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $team->delete();

        $userModel = config('teamwork.user_model');
        $userModel::where('current_team_id', $id)
                    ->update(['current_team_id' => null]);

        return json_encode(['success' => true]);
    }

    public function getTags($id) {
        // get team
        $team = Team::findOrFail($id);

        // check user is apart of team
        if (! auth()->user()->isOwnerOfTeam($team) && ! auth()->user()->isMemberOfTeam($team)) {
            abort(403);
        }

        // get all tags associated with all teams companyLeads 
        $companyLeads = $team->companyLeads;
        $tags = [];
        foreach ($companyLeads as $companyLead) {
            $tags = array_merge($tags, $companyLead->tags->toArray());
        }

        return $tags;
    }
}
