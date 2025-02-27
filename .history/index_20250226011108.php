<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


// require "vendor/autoload.php";
// Đảm bảo bạn đã tải .env để lấy cấu hình (sử dụng vlucas/phpdotenv)
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Lấy thông tin cấu hình từ .env
$connectionParams = [
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVE'],
    'port' => $_ENV['DB_PORT']
];

// Sử dụng Doctrine để kết nối
$connection = Doctrine\DBAL\DriverManager::getConnection($connectionParams);

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

const ROOT_PATH = __DIR__; //TẤT CẢ FILE ĐỀU TRUY CÂPJ ĐC   // khai báo ROOT_PATH


require "router.php";

