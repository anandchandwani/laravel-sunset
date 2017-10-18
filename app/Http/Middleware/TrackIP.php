<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;

class TrackIP
{
    /**
     * Create an entry in the "ips" table. Ips should be unique, so if it's a
     * known IP address do nothing.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $DEFAULT_APP_ID = 1;
        $ip = $request->ip();

        $ipRecord = app('db')->select("select * from ips where ip = '$ip'");
        $alreadyExists = count($ipRecord);

        if (!$alreadyExists){
            //TODO - Need a way to get identifier with each request.
            //Could set a custom HTTP header.
            $identifier = "default";

            $app = app('db')->select("select * from apps where name = '$identifier'")[0];

            app('db')->table('ips')->insert([
                'ip' => $request->ip(),
                'app_id' => $app->id,
                'is_blacklisted' => $app->default_blacklist,
                'redirect_url' => $app->default_redirect_url
            ]);
        }

        return $response;
    }
}