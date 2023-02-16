<?php

namespace App\Services;
use App\Events\UserInvitedToTeam;
use App\Models\Team;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class Teamwork
{
    

    /**
     * Invite an email adress to a team.
     * Either provide a email address or an object with an email property.
     *
     * If no team is given, the current_team_id will be used instead.
     *
     * @param string|User $user
     * @param null|Team $team
     * @param callable $success
     * @return TeamInvite
     * @throws \Exception
     */
    public function inviteToTeam($user, $team = null, callable $success = null)
    {
        if (is_null($team)) {
            $user = Auth::user();
            $team = $user->current_team_id;
        } elseif (is_object($team)) {
            $team = $team->getKey();
        } elseif (is_array($team)) {
            $team = $team['id'];
        }

        if (is_object($user) && isset($user->email)) {
            $email = $user->email;
        } elseif (is_string($user)) {
            $email = $user;
        } else {
            throw new \Exception('The provided object has no "email" attribute and is not a string.');
        }

        $invite = new Invite();
        $user = Auth::user();
        $invite->user_id = $user->getKey();
        $invite->team_id = $team;
        $invite->type = 'invite';
        $invite->email = $email;
        $invite->accept_token = md5(uniqid(microtime()));
        $invite->deny_token = md5(uniqid(microtime()));
        $invite->save();

        if (! is_null($success)) {
            event(new UserInvitedToTeam($invite));
            $success($invite);
        }

        return $invite->id;
    }

    /**
     * Checks if the given email address has a pending invite for the
     * provided Team.
     * @param $email
     * @param Team|array|int $team
     * @return bool
     */
    public function hasPendingInvite($email, $team)
    {
        if (is_object($team)) {
            $team = $team->getKey();
        }
        if (is_array($team)) {
            $team = $team['id'];
        }

        return Invite::where('email', '=', $email)->where('team_id', '=', $team)->first() ? true : false;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getInviteFromAcceptToken($token)
    {
        //  Get invite where accept_token = $token
        return Invite::where('accept_token', '=', $token)->first();
    }

    /**
     * @param TeamInvite $invite
     */
    public function acceptInvite(TeamInvite $invite)
    {
        $this->user()->attachTeam($invite->team);
        $invite->delete();
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getInviteFromDenyToken($token)
    {
        return $this->app->make(Config::get('teamwork.invite_model'))->where('deny_token', '=', $token)->first();
    }

    /**
     * @param TeamInvite $invite
     */
    public function denyInvite(TeamInvite $invite)
    {
        $invite->delete();
    }
}
