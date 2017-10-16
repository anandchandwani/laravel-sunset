<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/



// $router->get('/', ['middleware' => ['trackIP', 'trackRequest'], function () {
$router->get('/', ['middleware' => ['trackIP', 'trackRequest'], function () {
    
    $ip = app('request')->ip();
    $record = app('db')->select("select * from ips where ip = '$ip'");

    if (count($record) && $record[0]->is_blacklisted){
        return "Redirecting to " . $record[0]->redirect_url;
    }

    return "Hey, you're not blacklisted, no need to redirect you.";
}]);

$router->get('/clear', function () use ($router) {
    app('db')->delete("delete from requests");
    app('db')->delete("delete from ips");
    return "All ips and requests deleted, this is for development testing only.";
});



$router->get('/version', function () use ($router) {
    return $router->app->version();
});

// $router->options('/darkcloud/ips', function () use ($router) {
//     // return $results = app('db')->select("SELECT * FROM ips");
//     // $content = app('db')->select("SELECT * FROM ips");
//     return response('headers yo', 200)
//     ->header("Access-Control-Allow-Headers", "_headers,_normalizednames")
//     ->header('Access-Control-Allow-Origin', '*');
// });

$router->get('/darkcloud/ips', ['middleware' => ['corsMiddleware'], 
function () use ($router) { 
    $content = [
        'value' => app('db')->select("SELECT * FROM ips"),
        '@odata.count' => 2, //lol wtf is this shit
    ];

    return response($content, 200);
}]);

$router->get('/darkcloud', function () use ($router) {
    return view('index');
});

$router->get('/darkcloud2', function () use ($router) {
    $ips = app('db')->select("SELECT * FROM ips");
    $requests = app('db')->select("SELECT * FROM requests");
    return view('editable', ['ips' => $ips, 'requests' => $requests]);
});


$router->get('/darkcloud/json', function () use ($router) {
    return [
        'apps' => app('db')->select("SELECT * FROM apps"),        
        'ips' => app('db')->select("SELECT * FROM ips"),
        'requests' => app('db')->select("SELECT * FROM requests")
    ];
});


$router->get('/darkcloud/api/ip', 'IPController@all');
$router->get('/darkcloud/api/ip/{id}', 'IPController@find');
$router->post('/darkcloud/api/ip/', 'IPController@patch');



$router->get('/darkcloud/api/requests', 'RequestsController@all');
$router->patch('/darkcloud/api/requests/{id}', 'RequestsController@patch');

$router->post('/darkcloud/api/requests/', 'RequestsController@patchEditable');


