<?php

/** @var \Illuminate\Support\Facades\Route $router */

$router->get('/', function () use ($router) {
    return $router->app->version() . ' order app on ip:' . gethostbyname(gethostname());
});


$router->group(['prefix' => 'order'], function () use ($router) {

    $router->get('/', [
        'as' => 'get.orders',
        'uses' => 'OrderController@index'
    ]);

    $router->get('/{order}', [
        'as' => 'get.order',
        'uses' => 'OrderController@show'
    ]);

    $router->get('/user/{user}', [
        'as' => 'get.user.orders',
        'uses' => 'OrderController@showByUser'
    ]);

});