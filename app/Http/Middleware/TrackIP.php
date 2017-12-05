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

        $locationData = $this->detectLocation($ip);
        $country = isset($locationData['country_name']) ? $locationData['country_name'] : null;
        $countryCode = isset($locationData['country_code']) ? $locationData['country_code'] : null;
        $city = isset($locationData['city']) ? $locationData['city'] : null;

        $ipRecord = app('db')->select("select * from ips where ip = '$ip'");
        $alreadyExists = count($ipRecord);

        $identifier = $request->input('appName');
        
        if ($identifier == null){
            $identifier = "default";
        }

        if (!$alreadyExists){

            $app = app('db')->select("select * from apps where name = '$identifier'");

            //If identifier is a non-matching string
            if (count($app)){
                $app = $app[0];
            }
            else {
                return ["error" => true, 'message' => 'invalid appName'];
            }

            app('db')->table('ips')->insert([
                'ip' => $request->ip(),
                'app_id' => $app->id,
                'country' => ($country?$country:'-').($countryCode?"($countryCode)":'').($city?", $city":''),
                'time' => date('Y-m-d H:i:s', time()),
                'is_blacklisted' => $app->default_blacklist,
                'redirect_url' => $app->default_redirect_url
            ]);
        }

        return $response;
    }

    protected function detectLocation($ip)
    {
       try {
           $curl = curl_init();
           curl_setopt_array($curl, array(
               CURLOPT_RETURNTRANSFER => 1,
               CURLOPT_URL => 'http://freegeoip.net/json/' . $ip,
               CURLOPT_USERAGENT => 'PHP',
               CURLOPT_CONNECTTIMEOUT => 1,
           ));
           $result = curl_exec($curl);
           $data = json_decode($result, true) ?: [];

           return $data;
       } catch (\Throwable $e) {
           return [];
       }
    }

}