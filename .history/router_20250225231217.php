<?php

use Bramus\Router\Router;      //cai Bramus router
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Controllers\CategoryController;


use App\Controllers\AuthController;
use Doctrine\DBAL\DriverManager;
use eftec\bladeone\BladeOne;

$connectionParams = [
    'dbname' => 'your_database',
    'user' => 'your_user',
    'password' => 'your_password',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

// Kết nối DB bằng Doctrine
$db = DriverManager::getConnection($connectionParams);

// Cấu hình BladeOne (thư mục chứa views)
$views = __DIR__ . '/app/Views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

// Khởi tạo Controller với tham số
$authController = new AuthController($db, $blade);

// Sử dụng controller đã khởi tạo thay vì để Bramus tự động tạo
$router->get('/login', function () use ($authController) {
    $authController->showLoginForm();
});

$router->post('/login', function () use ($authController) {
    $authController->login();
});

$router->get('/logout', function () use ($authController) {
    $authController->logout();
});

$router->get('/login', 'App\Controllers\AuthController@showLoginForm');


$router = new Router();       //cai Bramus router

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