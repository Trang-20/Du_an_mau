<?php

namespace App\Controllers;

use eftec\bladeone\BladeOne;

class AuthController {
    protected $blade;

    public function __construct() {
        $views = __DIR__ . '/../../views';
        $cache = __DIR__ . '/../../cache';
        
        // Gán vào biến class để dùng trong các function khác
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
    }
    
    public function showLoginForm() {
        // Sử dụng $this->blade thay vì global $blade
        echo $this->blade->run("auth.login");
    }

    public function login() {
        session_start();
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === '123456') {
            $_SESSION['admin_logged_in'] = true;
            header("Location: /admin");
            exit;
        } else {
            // Sử dụng $this->blade
            echo $this->blade->run("auth.login", ["error" => "Sai tài khoản hoặc mật khẩu!"]);
        }
    }
}

