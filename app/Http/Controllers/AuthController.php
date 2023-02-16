<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Team;
use App\Models\User;
use App\Mail\InviteUser;
use App\Services\Teamwork as Teamwork;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($token)
    {
        return view('auth.member_register')->with('invite', $token);
    }
    /**
     * Accept the given invite.
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite($token, Teamwork $teamwork)
    {
        $invite = $teamwork->getInviteFromAcceptToken($token);
        if (!$invite) {
            abort(404);
        }

        if (auth()->check()) {
            $teamwork->acceptInvite($invite);
            return redirect()->route('dashboard');
        } else {
            // Store the invite token in the url so we can use it
            return redirect()->route('member/register', ['token' => $token]);
        }
    }
}
