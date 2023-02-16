<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JoinTeamListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    /**
     * See if the session contains an invite token on login and try to accept it.
     * @param mixed $event
     */
    public function handle($event)
    {
        if (session('invite_token')) {
            if ($invite = Teamwork::getInviteFromAcceptToken(session('invite_token'))) {
                Teamwork::acceptInvite($invite);
            }
            session()->forget('invite_token');
        }
    }
}
