<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** @var Router $router */
$router->group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api'], function (Router $router) {
    $router->post('register', 'AuthController@createUser');
    $router->post('login', 'AuthController@loginUser');
    $router->delete('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');
});

$router->group(['prefix' => 'movies', 'namespace' => 'App\Http\Controllers\Api\Movie'], function (Router $router) {
    $router->get('/', 'ListController@allMovies');
    $router->get('/daily', 'ListController@getDailyMovies');
    $router->get('/{id}', 'DetailController@getMovie');
});



Route::get('/test', function() {
    echo 1 . PHP_EOL;
});
