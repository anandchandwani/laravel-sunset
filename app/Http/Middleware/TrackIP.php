<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class TrackIP
{
    /**
     * Question - Do we want to log BEFORE, or AFTER request?
     * We're gonna be doing DB requests here, so potential performance.
     * 
     * Plan:
     *  - Track IP BEFORE responding
     *  - Track requests AFTER responding
     */
    public function handle($request, Closure $next)
    {

        $DEFAULT_APP_ID = 1;
        $response = $next($request);

        // TODO - IP SHOULD BE UNIQUE! Enforce in db?
        // TODO - If it's non-unqiue, don't log anything besides logging in TrackRequest.

        app('db')->table('ips')->insert([
            'ip' => $request->ip(),
            'app_id' => $DEFAULT_APP_ID,
            'is_blacklisted' => true, //TODO LOL. 
            'redirect_url' => 'https://www.reddit.com'
        ]);

        return $request->ip();
    }
}