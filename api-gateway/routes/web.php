<?php

/** @var \Illuminate\Support\Facades\Route $router */

$router->get('/', function () use ($router) {
    return $router->app->version() . ' api app on ip:' . gethostbyname(gethostname());
});


$router->group(['prefix' => 'user'], function () use ($router) {
    $router->get('/{user}/orders', [
        'as' => 'get.user.orders',
        'uses' => 'UserController@orders'
    ]);
});