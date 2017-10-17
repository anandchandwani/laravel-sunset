<?php

namespace App\Http\Middleware;

use Closure;

class TrackRequest
{
    /**
     * Note - Currently this does NOT track the very first request, it only
     * tracks once request is in IP. That's because it can only redirect after
     * it has a record of the IP.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // // Perform action
        $ip = $request->ip();
        $result = app('db')->select("select * from ips where ip = '$ip'");

        if (count($result) && $result[0]->is_blacklisted){
            app('db')->table('requests')->insert([
                'ip_id' => $result[0]->id,
                'redirected_to' => $result[0]->redirect_url,
            ]);
        }

        return $response;
    }
}