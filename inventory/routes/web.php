<?php

/** @var \Illuminate\Support\Facades\Route $router */

$router->get('/', function () use ($router) {
    return $router->app->version() . ' inventory app on ip:' . gethostbyname(gethostname());
});


$router->group(['prefix' => 'product'], function () use ($router) {
    $router->get('/', [
        'as' => 'get.products',
        'uses' => 'ProductController@index'
    ]);

    $router->get('/{product}', [
        'as' => 'get.product',
        'uses' => 'ProductController@show'
    ]);
});