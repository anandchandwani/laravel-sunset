<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class TrackIP
{
    /**
     * Question - Do we want to log BEFORE, or AFTER request?
     * We're gonna be doing DB requests here, so potential performance.
     * Solution: AFTER requests, so that the first run through the controller is before it's been logged.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $DEFAULT_APP_ID = 1;
        $ip = $request->ip();

        //Potentially refactor for speed by eliminating 2 db hits here. Can get it down to 1.
        $alreadyExists = count(app('db')->select("select * from ips where ip = '$ip'"));

        if (!$alreadyExists){
            app('db')->table('ips')->insert([
                'ip' => $request->ip(),
                'app_id' => $DEFAULT_APP_ID,
                'is_blacklisted' => true, //TODO LOL. 
                'redirect_url' => 'https://www.reddit.com'
            ]);
        }

        return $response;
    }
}