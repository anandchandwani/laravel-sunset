<?php

namespace App\Http\Middleware;

use Closure;

class TrackRequest
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // // Perform action
        $ip = $request->ip();
        $result = app('db')->select("select * from ips where ip = '$ip'")[0];
        app('db')->table('requests')->insert([
            'ip_id' => $result->id,
            'redirected_to' => $result->redirect_url, //TODO LOL. 
        ]);

        return $response;
    }
}