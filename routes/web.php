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



$router->get('/', ['middleware' => ['trackIP', 'trackRequest'], function () {
    return "Hello, world.";
}]);

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->get('/ips', function () use ($router) {
    return $results = app('db')->select("SELECT * FROM ips");
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
    // return $results = app('db')->select("SELECT * FROM ips");
    // $content = app('db')->select("SELECT * FROM ips");
    $content = [
        'value' => app('db')->select("SELECT * FROM ips"),
        '@odata.count' => 2, //lol wtf is this shit
    ];

    return response($content, 200);
    // ->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE')
    // ->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'))
    // ->header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers")
    // ->header("Access-Control-Allow-Headers", "*")
    // ->header("Access-Control-Allow-Headers", request()->header('Access-Control-Request-Headers'))
    // ->header("Access-Control-Allow-Headers", "_headers,_normalizednames")
    // ->header('Access-Control-Allow-Origin', '*');
}]);

$router->get('/darkcloud', function () use ($router) {
    return view('index');
});



