<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActiveTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // only redirect if the user isn't on the screen
        if ($request->route()->getName() == 'teams.create') {
            return $next($request);
        }

        // check the user has an team
        $currentTeam = $request->user()->currentTeam;
        if(!$currentTeam) {
            if ($request->user()->teams()->count() > 0) {
                // set the first team as the active team
                $activeTeam = $request->user()->teams()
                    ->where('invite', 0)
                    ->where('active', 1)
                    ->firstOrFail();

                $request->user()->switchTeam($activeTeam);
                return redirect()->route('dashboard');
            } else {
                // return the user to create a team
                return redirect()->route('teams.create');
            }
        } else {           
            //  get team user where team_id = current team id
            $teamCollection = $request->user()->teams()->get();

            // go through each team collection and find the current team
            $teamUser = $teamCollection->first(function ($team) use ($currentTeam) {
                return $team->id == $currentTeam->id;
            });


            
            if($teamUser->pivot->active == 0) {
                if ($request->user()->teams()->count() > 0) {
                    // set the first team as the active team
                    $activeTeam = $request->user()->teams()
                        ->where('invite', 0)
                        ->where('active', 1)
                        ->firstOrFail();

                    $request->user()->switchTeam($activeTeam);
                    return redirect()->route('dashboard');
                } else {
                    // set current team to null
                    $request->user()->currentTeam()->dissociate();
                    $request->user()->save();
                    // return the user to create a team
                    return redirect()->route('teams.create');
                }
            }

        }
        return $next($request);
    }
}
