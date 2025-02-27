<?php
use eftec\bladeone\BladeOne;

require_once __DIR__ . '/../vendor/autoload.php'; // Nạp Composer autoload

$views = __DIR__ . '/../views';  // Thư mục chứa file giao diện
$cache = __DIR__ . '/../cache';  // Thư mục cache để BladeOne hoạt động

// Kiểm tra và tạo thư mục cache nếu chưa có
if (!file_exists($cache)) {
    mkdir($cache, 0777, true);
}

// Khởi tạo BladeOne
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
