<?php
<?php
use Bramus\Router\Router;
use App\Controllers\ProductController;
use App\Controllers\UserController;

$router = new Router();

// Route trang chủ
$router->get('/', function() {
    echo "Trang chủ!";
});

// Routes cho products
$router->get('/products', [ProductController::class, 'index']);
$router->get('/products/create', [ProductController::class, 'create']);
$router->post('/products/store', [ProductController::class, 'store']);
$router->get('/products/{id}/edit', [ProductController::class, 'edit']);
$router->post('/products/{id}/update', [ProductController::class, 'update']);
$router->get('/products/{id}/delete', [ProductController::class, 'delete']);

// Routes cho users
$router->get('/users', [UserController::class, 'index']);
$router->get('/users/create', [UserController::class, 'create']);
$router->post('/users/store', [UserController::class, 'store']);
$router->get('/users/{id}/edit', [UserController::class, 'edit']);
$router->post('/users/{id}/update', [UserController::class, 'update']);
$router->get('/users/{id}/delete', [UserController::class, 'delete']);

// require_once __DIR__ . '/vendor/autoload.php';  // Đảm bảo autoload được load

// // use Bramus\Router\Router;
// // use App\Controllers\ProductController;
// // use App\Controllers\UserController;

// // $router = new Router();

// // $router->get('/', function() {
// //     echo "Trang chủ!";
// // });
// // // Routes cho products
// // $router->mount('/products', function() use ($router) {
// //     $router->get('/', 'App\Controllers\ProductController@index');
// //     $router->get('/create', 'App\Controllers\ProductController@create');
// //     $router->post('/store', 'App\Controllers\ProductController@store');
// //     $router->get('/{id}/edit', 'App\Controllers\ProductController@edit');
// //     $router->post('/{id}/update', 'App\Controllers\ProductController@update');
// //     $router->get('/{id}/delete', 'App\Controllers\ProductController@delete');
// // });

// // // Routes cho users
// // $router->mount('/users', function() use ($router) {
// //     $router->get('/', 'App\Controllers\UserController@index');
// //     $router->get('/create', 'App\Controllers\UserController@create');
// //     $router->post('/store', 'App\Controllers\UserController@store');
// //     $router->get('/{id}/edit', 'App\Controllers\UserController@edit');
// //     $router->post('/{id}/update', 'App\Controllers\UserController@update');
// //     $router->get('/{id}/delete', 'App\Controllers\UserController@delete');
// // });

// // $router->run();




// use Bramus\Router\Router;      //cai Bramus router
// use App\Controllers\ProductController;
// use App\Controllers\UserController;



// $router = new Router();       //cai Bramus router



$router->get('/', function() {
    echo "Trang chủ!";
});

// $router->mount('/products', function() use($router) {
    // $router->get('/', ProductController::class . '@index');
    $router->get('/products', [ProductController::class, 'index']);

//     $router->get('/create', ProductController::class . '@create');
//     $router->post('/store', ProductController::class . '@store');
//     $router->get('/{id}/edit', ProductController::class . '@edit');
//     $router->post('/{id}/update', ProductController::class . '@update');
//     $router->get('/{id}/delete', ProductController::class . '@delete');

// });

// $router->mount('/users', function() use($router) {
//     $router->get('/', UserController::class . '@index');
//     $router->get('/create', UserController::class . '@create');
//     $router->post('/store', UserController::class . '@store');
//     $router->get('/{id}/edit', UserController::class . '@edit');
//     $router->post('/{id}/update', UserController::class . '@update');
//     $router->get('/{id}/delete', UserController::class . '@delete');

// });
require 'vendor/autoload.php';

$router = new Router();

// Kiểm tra route đơn giản
// $router->get('/', function() {
//     echo "Trang chủ hoạt động!";
// });

// Kiểm tra route Product
// $router->get('/products', function() {
//     echo "Trang danh sách sản phẩm!";
// });

// Kiểm tra route User
$router->get('/users', function() {
    echo "Trang danh sách người dùng!";
});


$router->run();   //cai Bramus router 