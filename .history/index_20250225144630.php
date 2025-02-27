<?php

// session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

const ROOT_PATH = __DIR__; //TẤT CẢ FILE ĐỀU TRUY CÂPJ ĐC   // khai báo ROOT_PATH



require "router.php";

