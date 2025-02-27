<?php

namespace App\Controllers;

use eftec\bladeone\BladeOne;

class AuthController {
    protected $blade;

    public function __construct($blade) { 
        $this->blade = $blade; 
    }

        public function showLoginForm() {
            echo $this->blade->run("auth.login");
        }

    public function login() {
       
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === $_POST['username'] && $password ===  $_POST['password']) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: dashboard.php");
            exit;
        } else {
            echo $this->blade->run("login.php", ["error" => "Sai tài khoản hoặc mật khẩu!"]);
        }
    }
}
