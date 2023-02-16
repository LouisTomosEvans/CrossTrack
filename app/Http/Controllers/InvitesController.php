<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;


class InvitesController extends Controller
{
    public function destroy($team_id, $invite_id)
    {
        $team = Team::findOrFail($team_id);
        if (!auth()->user()->isOwnerOfTeam($team)) {
            abort(403);
        }

        // find invite
        $invite = $team->invites()->where('id', $invite_id)->first();  

        // delete invite
        $invite->delete();

        return json_encode(['success' => true]);
    }
}
