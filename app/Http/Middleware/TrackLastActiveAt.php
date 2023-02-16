<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class TrackLastActiveAt
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
        if (! $request->user()) {
            return $next($request);
        }

        if (! $request->user()->last_active_at || $request->user()->last_active_at->lt(Carbon::now()->subMinutes(2))) {
            $request->user()->forceFill([
                'last_active_at' => Carbon::now(),
            ])->save();
        }

        return $next($request);
    }
}
