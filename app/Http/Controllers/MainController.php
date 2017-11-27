<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('trackIP', ['only' => ['get']]);
        $this->middleware('trackRequest', ['only' => ['get']]);
    }
    
    public function get(){
        $requestIP = app('request')->ip();
        $record = app('db')->select("select * from ips where ip = '$requestIP'");
    
        if (empty($record)){
            return noRedirectResponse();
        }
    
        $ip = $record[0];
              
        //Blacklisted IPs should NEVER be redirected.
        if ($ip->is_blacklisted){
            return noRedirectResponse();
        }

        $app = app('db')->select("select * from apps where id = " . $ip->app_id)[0];
    
        //App campaign redirect rules
        if ($app->redirect_override === "always_redirect"){
            return redirectResponse($ip->redirect_url);
        }
        else if ($app->redirect_override === "never_redirect"){
            return noRedirectResponse();
        }
    }

    //
}

function noRedirectResponse(){
    // return "You're not being blacklisted, no reason to redirect.";
    return null;
}

function redirectResponse($url){
    // return "Redirecting to " . $url;
    return [
        'r' => $url,
        'r_secure' => base64_encode($url),
        'redirecting' => true,
    ];
    // return ['r' => base64_encode($url)];
}