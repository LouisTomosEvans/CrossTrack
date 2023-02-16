<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckNotActiveTeam
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
        // check if user doesn't have an active team
        if ($request->user()->currentTeam) {
            return redirect()->route('dashboard');
        } else {
            return $next($request);
        }
    }
}
