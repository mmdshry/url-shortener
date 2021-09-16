<?php

use Laravel\Lumen\Routing\Router;

assert($router instanceof Router);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/{redirectId}', 'UrlController@redirectUrl');

$router->group(['prefix' => 'api/url', 'as'=>'API.URL.'], function () use ($router) {
    $router->get('', 'UrlController@index');
    $router->get('{redirectId}', 'UrlController@show');
    $router->post('', 'UrlController@create');
    $router->put('', 'UrlController@update');
    $router->delete('{redirectId}', 'UrlController@destroy');
});
