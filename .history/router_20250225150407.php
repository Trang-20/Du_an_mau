<?php

use Bramus\Router\Router;      //cai Bramus router
use App\Controllers\ProductController;


$router = new Router();       //cai Bramus router

require_once __DIR__ . '/vendor/autoload.php'; // Load Composer autoload
use App\Controllers\ProductController;


// ĐN bramus router
// use Dotenv\Dotenv;


// TẠO RA ĐỐI TƯỢNG .env



// Define router

$router->mount('/products', function() use($router) {
    $router->get('/', function() {
        $controller = new ProductController();
        $controller->index();
    });
// });



// $router->mount('/products', function() use($router) {
//     $router->get('/', ProductController::class . '@index');
    // $router->get('/create', ProductController::class . '@create');
    // $router->post('/store', ProductController::class . '@store');
    // $router->get('/{id}/edit', ProductController::class . '@edit');
    // $router->post('/{id}/update', ProductController::class . '@update');
    // $router->get('/{id}/delete', ProductController::class . '@delete');

});


$router->run();   //cai Bramus router 