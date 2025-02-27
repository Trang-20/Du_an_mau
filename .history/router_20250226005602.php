<?php
use Bramus\Router\Router;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use App\Controllers\CategoryController;
use Doctrine\DBAL\DriverManager;
use eftec\bladeone\BladeOne;
use App\Controllers\AuthController;
 

// session_start();
$router = new Router();
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra thông tin đăng nhập (ví dụ so sánh với cơ sở dữ liệu)
$storedUsername = 'admin';  // Tên người dùng đã lưu trong cơ sở dữ liệu (giả sử)
$storedPasswordHash = '$2y$10$KIX....';  // Mật khẩu đã mã hóa trong cơ sở dữ liệu (giả sử)
$userId = 1;  // ID người dùng trong cơ sở dữ liệu (giả sử)

if ($username == $username && $password == $password) {
    // Đăng nhập thành công, lưu thông tin vào session
    $_SESSION['user_id'] = $userId;  // Lưu ID người dùng
    $_SESSION['username'] = $username;  // Lưu tên người dùng

    // Chuyển hướng đến trang quản trị hoặc trang chính
    header('Location: dashboard.php');  // Ví dụ, chuyển hướng đến trang dashboard
    exit;
} else {
    // Nếu tên người dùng hoặc mật khẩu sai
    echo "Tên người dùng hoặc mật khẩu không đúng.";
}

// Cấu hình database

$db = DriverManager::getConnection($connectionParams);

// Sửa đường dẫn BladeOne Views
$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

$authController = new AuthController($blade, $db);

$router->get('/login', function () use ($authController) {
    $authController->showLoginForm();
});

$router->post('/login', function () use ($authController) {
    $authController->login();
});

$router->mount('/products', function() use($router) {
    $router->get('/',              ProductController::class . '@index');
    $router->get('/create',        ProductController::class . '@create');
    $router->post('/store',        ProductController::class . '@store');
    $router->get('/{id}/edit',     ProductController::class . '@edit');
    $router->post('/{id}/update',  ProductController::class . '@update');
    $router->get('/{id}/delete',   ProductController::class . '@delete');
});

$router->mount('/users', function() use($router) {
    $router->get('/',             UserController::class . '@index');
    $router->get('/create',       UserController::class . '@create');
    $router->post('/store',       UserController::class . '@store');
    $router->get('/{id}/edit',    UserController::class . '@edit');
    $router->post('/{id}/update', UserController::class . '@update');      
    $router->get('/{id}/delete',  UserController::class . '@delete');
});

$router->mount('/categories', function() use($router) {
    $router->get('/',             CategoryController::class . '@index');
    $router->get('/create',       CategoryController::class . '@create');
    $router->post('/store',       CategoryController::class . '@store');
    $router->get('/{id}/edit',    CategoryController::class . '@edit');
    $router->post('/{id}/update', CategoryController::class . '@update');      
    $router->get('/{id}/delete',  CategoryController::class . '@delete');
});

$router->run();
