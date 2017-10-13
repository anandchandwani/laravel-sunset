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
        // $response = $next($request);

        // // Perform action

        // $results = app('db')->select("SELECT * FROM users");

        // return $response;

        // return $next($request); 

        $DEFAULT_APP_ID = 1;

        $response = $next($request);

        // DB::table('ips')->insert([
        app('db')->table('ips')->insert([
            'ip' => $request->ip(),
            'app_id' => $DEFAULT_APP_ID,
            'is_blacklisted' => true, //TODO LOL. 
            'redirect_url' => 'https://www.reddit.com'
        ]);

        //  if(!method_exists($response, 'render'))
        //      return $response;

        //  $content = $response->render(); 
        // return $request->headers->all(); 
        return $request->ip();
        //  return 'Doop';      
    }
}