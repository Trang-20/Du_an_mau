<?php

use Bramus\Router\Router;      //cai Bramus router
use App\Controllers\ProductController;
use App\Controllers\ProductController;



$router = new Router();       //cai Bramus router




$router->mount('/products', function() use($router) {
    $router->get('/', ProductController::class . '@index');
    $router->get('/create', ProductController::class . '@create');
    $router->post('/store', ProductController::class . '@store');
    $router->get('/{id}/edit', ProductController::class . '@edit');
    $router->post('/{id}/update', ProductController::class . '@update');
    $router->get('/{id}/delete', ProductController::class . '@delete');

});

$router->mount('/user', function() use($router) {
    $router->get('/', UserController::class . '@index');
    $router->get('/create', UserController::class . '@create');
    $router->post('/store', UserController::class . '@store');
    $router->get('/{id}/edit', UserController::class . '@edit');
    $router->post('/{id}/update', UserController::class . '@update');
    $router->get('/{id}/delete', UserController::class . '@delete');

});

$router->run();   //cai Bramus router 