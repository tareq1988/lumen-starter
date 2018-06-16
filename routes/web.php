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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'Auth\LoginController@login');
$router->post('/register', 'Auth\RegisterController@register');
$router->get('/me', 'ProfileController@currentProfile');
$router->post('/me', 'ProfileController@updateCurrentProfile');
$router->post('/me/password', 'ProfileController@updatePassword');
