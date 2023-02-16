<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUser;
use App\Services\Teamwork as Teamwork;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Invite a new user to the given team.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Return the members of the given team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // check user apart of team
        if (!auth()->user()->isMemberOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $team = Team::with('users', 'invites')->findOrFail($id);
        $team->members = $team->users->merge($team->invites);

        foreach ($team->members as $member) {
            if ($member->name == '') {
                $member->name = "Invited User";
            }

            if (!isset($member->pivot)) {
                $member->pivot = new \stdClass();
                $member->pivot->invite = 1;
            }
        }


        return $team->members;
    }

    // update
    public function updateStatus(Request $request, $team_id, $user_id)
    {

        if (!auth()->user()->isOwnerOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }
        
        $user = User::findOrFail($user_id);
        
        $team = $user->teams()->where('team_id', $team_id)->firstOrFail();
        
        $team->pivot->update(['active' => !$team->pivot->active]);
        
        if (!$team->pivot->active && $user->current_team_id === $team_id) {
            $user->switchTeam($user->teams()->where('active', 1)->first());
        }

        return json_encode(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $team_id
     * @param int $user_id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($team_id, $user_id)
    {
        $team = Team::findOrFail($team_id);
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        $user = User::findOrFail($user_id);
        if ($user->getKey() === auth()->user()->getKey()) {
            abort(403);
        }

        $user->detachTeam($team);
        


        return json_encode(['success' => true]);
    }

    /**
     * @param Request $request
     * @param int $team_id
     * @return $this
     */
    public function invite(Request $request, $team_id, Teamwork $teamwork)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // check user is owner
        if (!auth()->user()->isOwnerOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        // if user already exists, add to team with active status as null
        $user = User::where('email', $request->email)->first();
        $team = Team::findOrFail($team_id);
        if ($user) {
            $user->attachTeam($team_id, ['invite' => true]);

            // notify user that they have been invited to a team
            // Mail::send(new InviteUser($user, $team))->to($user->email)->subject('Invitation to join team '. $invite->team->name);
            return json_encode(['success' => true]);
        }

        if (! $teamwork->hasPendingInvite($request->email, $team)) {
            $invite = $teamwork->inviteToTeam($request->email, $team, function ($invite) {
                Mail::send('mail.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
                    $m->to($invite->email)->subject('Invitation to join team '. $invite->team->name);
                });
                // Send email to user
            });
        } else {
            return redirect()->back()->withErrors([
                'email' => 'The email address is already invited to the team.',
            ]);
        }

        return json_encode(['success' => true]);
    }

    /**
     * Resend an invitation mail.
     *
     * @param $invite_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resendInvite($invite_id)
    {
        // check user is owner
        if (!auth()->user()->isOwnerOfTeam(auth()->user()->currentTeam)) {
            abort(403);
        }

        $invite = Invite::findOrFail($invite_id);
        Mail::send('teamwork.emails.invite', ['team' => $invite->team, 'invite' => $invite], function ($m) use ($invite) {
            $m->to($invite->email)->subject('Invitation to join team '.$invite->team->name);
        });

        return json_encode(['success' => true]);
    }

    // leave team
    public function leaveTeam($team_id)
    {
        $team = Team::findOrFail($team_id);
        $user = auth()->user();

        // check user is not owner
        if ($user->isOwnerOfTeam($team)) {
            abort(403);
        }

        $user->detachTeam($team);

        // Switch to another team
        $team = $user->teams()->where('active', 1)->first();
        if ($team) {
            $user->switchTeam($team);
        } else {
            $user->current_team_id = null;
            $user->save();
        }


        return json_encode(['success' => true]);
    }

    public function joinTeam($team_id, $user_id){
        $team = Team::findOrFail($team_id);
        $user = User::findOrFail($user_id);

        // check user is not owner
        if (auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        // check user is invited
        if (!$user->isInvitedToTeam($team)) {
            abort(403);
        }

        // check user is not already a member
        if ($user->isMemberOfTeam($team)) {
            abort(403);
        }

        $user->teams()->updateExistingPivot($team_id, ['invite' => false, 'active' => true]);
        $user->save();

        // switch to team
        $user->switchTeam($team);

        return json_encode(['success' => true]);
    }

    public function denyTeam($team_id, $user_id){
        $team = Team::findOrFail($team_id);
        $user = User::findOrFail($user_id);

        // check user is owner
        if (auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        // check user is invited
        if (!$user->isInvitedToTeam($team)) {
            abort(403);
        }

        // check user is not already a member
        if ($user->isMemberOfTeam($team)) {
            abort(403);
        }

        $user->detachTeam($team);
        $user->save();

        return json_encode(['success' => true]);
    }
}
