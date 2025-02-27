<?php
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require "vendor/autoload.php"; // Đảm bảo gọi autoload trước khi dùng Router

use Bramus\Router\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

const ROOT_PATH = __DIR__; // Khai báo ROOT_PATH

$router = new Router();

require "router.php";  // Gọi router.php

$router->run();  // Chạy router




// session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);


// require "vendor/autoload.php";

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// const ROOT_PATH = __DIR__; //TẤT CẢ FILE ĐỀU TRUY CÂPJ ĐC   // khai báo ROOT_PATH



// require "router.php";

