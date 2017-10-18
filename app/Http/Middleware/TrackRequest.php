<?php

namespace App\Http\Middleware;

use Closure;

class TrackRequest
{
    /**
     * Creates an entry in 'Requests'. It does NOT track the very first request
     * (when the IP is first logged), but will log future requests.
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
                'created_at' => new \DateTime(),
            ]);
        }

        return $response;
    }
}