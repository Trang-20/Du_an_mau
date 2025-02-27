<?php

namespace App\Middleware;

class AuthMiddleware
{
    public static function checkAdmin()
    {
        session_start();
        if (!isset($_SESSION['admin_logged_in'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập để truy cập!";
            header("Location: /login");
            exit;
        }
    }
}
