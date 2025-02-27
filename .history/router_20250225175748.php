<?php

use Bramus\Router\Router;      //cai Bramus router
use App\Controllers\ProductController;
// use App\Controllers\UserController;



$router = new Router();       //cai Bramus router



$router->get('/', function() {
    echo "Trang chủ!";
});

$router->mount('/products', function() use($router) {
    $router->get('/', ProductController::class . '@index');
    $router->get('/create', ProductController::class . '@create');
    // $router->get('/createU', ProductController::class . '@createU');
    $router->post('/store', ProductController::class . '@store');
    $router->get('/{id}/edit', ProductController::class . '@edit');
    $router->post('/{id}/update', ProductController::class . '@update');
    $router->get('/{id}/delete', ProductController::class . '@delete');

});

$router->mount('/user', function() use($router) {
    echo "124";
    // $router->get('/', UserController::class . '@index');
});

$router->run();   //cai Bramus router 