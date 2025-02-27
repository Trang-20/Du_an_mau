<?php

namespace App\Controllers;

use eftec\bladeone\BladeOne;

class AuthController {
    protected $blade;

        public function __construct() {
         
            $views = __DIR__ . '/../../views';
            $cache = __DIR__ . '/../../cache';
            
            $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // Bật debug để kiểm tra lỗi
            $blade->setBaseUrl('/'); // Đặt base URL nếu cần

            echo $blade->run("auth.login");

            // echo "BladeOne Views Path: " . $views; // Debug đường dẫn
            // exit();
            // echo "BladeOne Views Path: " . realpath($views);
            // exit();
            
    }


    public function login() {
        session_start();
        $user_name = $_POST['user_name'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === '123456') {
            $_SESSION['admin_logged_in'] = true;
            header("Location: /admin");
            exit;
        } else {
            global $blade;
            echo $blade->run("auth.login", ["error" => "Sai tài khoản hoặc mật khẩu!"]);
        }
    }
    public function showLoginForm() {
        global $blade;
        echo $blade->run("auth.login");
    }
}


// namespace App\Controllers;

// use Doctrine\DBAL\Connection;
// use eftec\bladeone\BladeOne;

// class AuthController
// {
//     protected $db;
//     protected $blade;

//     public function __construct($db, $blade)
//     {
//         $this->db = $db;
//         $this->blade = $blade;
//     }

//     public function showLoginForm()
//     {
//         echo $this->blade->run("login", ['error' => $_SESSION['error'] ?? null]);
//         unset($_SESSION['error']); // Xóa thông báo sau khi hiển thị
//     }

//     public function login()
//     {
//         session_start();

//         $email = $_POST['email'] ?? '';
//         $password = $_POST['password'] ?? '';

//         // Kiểm tra nếu rỗng
//         if (empty($email) || empty($password)) {
//             $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
//             header("Location: /login");
//             exit;
//         }

//         // Lấy user từ DB
//         $user = $this->db->fetchAssociative("SELECT * FROM users WHERE email = ?", [$email]);

//         if (!$user || !password_verify($password, $user['password'])) {
//             $_SESSION['error'] = "Email hoặc mật khẩu không đúng!";
//             header("Location: /login");
//             exit;
//         }

//         // Kiểm tra role
//         if ($user['role'] !== 'admin') {
//             $_SESSION['error'] = "Bạn không có quyền truy cập!";
//             header("Location: /login");
//             exit;
//         }

//         // Lưu session
//         $_SESSION['admin_logged_in'] = true;
//         $_SESSION['admin_email'] = $user['email'];

//         header("Location: /admin");
//         exit;
//     }

//     public function logout()
//     {
//         session_start();
//         session_destroy();
//         header("Location: /login");
//         exit;
//     }
// }
