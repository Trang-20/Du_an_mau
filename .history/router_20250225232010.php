<?php

use Bramus\Router\Router;      //cai Bramus router
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Controllers\CategoryController;

use App\Controllers\AuthController;
use Doctrine\DBAL\DriverManager;
use eftec\bladeone\BladeOne;

$router = new Router();
$router = new Router();       //cai Bramus router
// Cấu hình database
$connectionParams = [
    'dbname' => 'your_database',
    'user' => 'your_user',
    'password' => 'your_password',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$db = DriverManager::getConnection($connectionParams);

// Cấu hình BladeOne
$views = __DIR__ . '/app/Views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
// Khởi tạo Controller
$authController = new AuthController($blade, $db); // BladeOne truyền trước, DBAL truyền sau

// Định nghĩa route đăng nhập
$router->get('/login', function () use ($authController) {
    $authController->showLoginForm();
});

// Chạy Router


$router->mount('/products', function() use($router) {
    $router->get('/',              ProductController::class . '@index');        //list-pro
    $router->get('/create',        ProductController::class . '@create');      //get_add-pro
    $router->post('/store',        ProductController::class . '@store');       //post_add-pro
    $router->get('/{id}/edit',     ProductController::class . '@edit');         //get_update-pro
    $router->post('/{id}/update',  ProductController::class . '@update');       //post_update-pro
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

$router->mount('/categories', function() use($router) {
    // echo "ahihi";
    $router->get('/',             CategoryController::class . '@index');
    $router->get('/create',       CategoryController::class . '@create');
    $router->post('/store',       CategoryController::class . '@store');
    $router->get('/{id}/edit',    CategoryController::class . '@edit');     //get-pro
    $router->post('/{id}/update', CategoryController::class . '@update');      
    $router->get('/{id}/delete',  CategoryController::class . '@delete');

});

$router->run();   //cai Bramus router 