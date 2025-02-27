<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require "vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

const ROOT_PATH = __DIR__; //TẤT CẢ FILE ĐỀU TRUY CÂPJ ĐC   // khai báo ROOT_PATH
require_once __DIR__ . '/router.php';


require "router.php";

