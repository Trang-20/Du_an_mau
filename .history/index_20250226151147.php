<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

re'; // Đảm bảo đường dẫn đúng

require_once __DIR__ . '/vendor/autoload.php'; // Load Composer Autoload
require_once __DIR__ . '/config/blade.php';

use Dotenv\Dotenv;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

// Load environment variables (chỉ gọi 1 lần)
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();



// Định nghĩa hằng số đường dẫn gốc
const ROOT_PATH = __DIR__;


    $connectionParams = [
        'dbname'   => $_ENV['DB_NAME'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'host'     => $_ENV['DB_HOST'],
        'driver'   => 'pdo_mysql', // CHỈ ĐỊNH TRỰC TIẾP THAY VÌ $_ENV
        'port'     => $_ENV['DB_PORT'],
    ];

    $connection = DriverManager::getConnection($connectionParams);
 


// Kết nối CSDL bằng Doctrine
try {
    $connection = DriverManager::getConnection($connectionParams);
} catch (Exception $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}

// Load Router
require "router.php";
