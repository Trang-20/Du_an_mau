<?php

use Bramus\Router\Router;      //cai Bramus router
use App\Controllers\ProductController;
use App\Controllers\UserController;



$router = new Router();       //cai Bramus router



$router->get('/', function() {
    echo "Trang chủ!";
});

$router->mount('/products', function() use($router) {
    $router->get('/',               ProductController::class . '@index');  //list-pro
    $router->get('/create',        ProductController::class . '@create');      //get_add-pro
    $router->post('/store',        ProductController::class . '@store');       //post_add-pro
    $router->get('/{id}/edit',     ProductController::class . '@edit');     //get-pro
    $router->post('/{id}/update',  ProductController::class . '@update');    //post_add-pro
    $router->get('/{id}/delete',   ProductController::class . '@delete');        //get_delete-pro

});

$router->mount('/users', function() use($router) {
    // echo "hi";
    $router->get('/',             UserController::class . '@index');
    $router->get('/create',       UserController::class . '@create');
    $router->post('/store',       UserController::class . '@store');
    $router->get('/{id}/edit',    UserController::class . '@edit');     //get-pro
    $router->post('/{id}/update', UserController::class . '@update');      
    $router->get('/{id}/delete',  UserController::class . '@delete');

});

$router->run();   //cai Bramus router 