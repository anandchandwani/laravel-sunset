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

$router->get('/', 'MainController@get');

$router->get('/clear', ['middleware' => 'auth', function () use ($router) {
    app('db')->delete("delete from requests");
    app('db')->delete("delete from ips");
    return "All ips and requests deleted.";
}]);



$router->get('/version', ['middleware' => 'auth', function () use ($router) {
    return $router->app->version();
}]);


$router->get('/darkcloud/ips', ['middleware' => ['auth', 'corsMiddleware'],
function () use ($router) { 
    $content = [
        'value' => app('db')->select("SELECT * FROM ips"),
        '@odata.count' => 2, //lol wtf is this shit
    ];

    return response($content, 200);
}]);

$router->get('/darkcloud_angular', ['middleware' => 'auth', function () use ($router) {
    return view('index');
}]);

$router->get('/darkcloud', ['middleware' => 'auth', function () use ($router) {
    $ips = app('db')->select("SELECT * FROM ips");
    $requests = app('db')->select("SELECT * FROM requests");
    $apps = app('db')->select("SELECT * FROM apps");

    return view('editable', [
        'ips' => $ips, 
        'requests' => $requests,
        'apps' => $apps
    ]);
}]);



$router->get('/darkcloud/options', ['middleware' => 'auth', function () use ($router) {
    return view('options');
}]);

$router->get('/darkcloud/ips/{id}', ['middleware' => 'auth', function ($id) {
    $ips = app('db')->select("SELECT * FROM ips where id = " .$id);
    return view('editable', [ 'ips' => $ips, 'requests' => []]);
    // return $ips;
}]);


$router->get('/darkcloud/json', ['middleware' => 'auth', function () use ($router) {
    return [
        'apps' => app('db')->select("SELECT * FROM apps"),        
        'ips' => app('db')->select("SELECT * FROM ips"),
        'requests' => app('db')->select("SELECT * FROM requests")
    ];
}]);


$router->get('/darkcloud/api/ip', 'IPController@all');
$router->get('/darkcloud/api/ip/{id}', 'IPController@find');
$router->post('/darkcloud/api/ip/', 'IPController@patch');



$router->get('/darkcloud/api/requests', 'RequestsController@all');
// $router->patch('/darkcloud/api/requests/{id}', 'RequestsController@patch');
$router->post('/darkcloud/api/requests/', 'RequestsController@patchEditable');
$router->get('/darkcloud/api/apps/', 'AppsController@all');
$router->post('/darkcloud/api/apps/', 'AppsController@post');
$router->post('/darkcloud/api/apps/create', 'AppsController@createApp');

$router->delete('/darkcloud/api/apps', 'AppsController@delete');

$router->delete('/darkcloud/api/ip/', 'IPController@delete');


$router->get('/add-to-blacklist', ['middleware' => 'auth', function () use ($router) {
    return view('add-to-blacklist');
}]);