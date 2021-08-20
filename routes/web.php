<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

use App\Services\UrlService;

$router->get('/', function () {
    return view('index');
});

$router->get('/test', function () {
    $UrlService = new UrlService();
    $url = 'https://example.com/foo/bar?qs=baz';
    dd(uniqid());
});
