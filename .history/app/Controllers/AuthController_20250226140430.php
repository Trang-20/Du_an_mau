<?php
namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;
use Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load biến môi trường từ .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2)); // Đúng thư mục chứa .env
$dotenv->safeLoad();

// Kết nối CSDL với Doctrine DBAL
$connectionParams = [
    'dbname'   => $_ENV['DB_NAME'] ?? '',
    'user'     => $_ENV['DB_USER'] ?? '',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
    'host'     => $_ENV['DB_HOST'] ?? '',
    'driver'   => $_ENV['DB_DRIVER'] ?? '',
    'port'     => $_ENV['DB_PORT'] ?? ''
];

try {
    $conn = DriverManager::getConnection($connectionParams);
} catch (Exception $e) {
    die("Lỗi kết nối CSDL: " . $e->getMessage());
}

class AuthController {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function showLoginForm() {
        require_once __DIR__ . '/views/login.php'; // Điều chỉnh đường dẫn nếu cần
    }
    

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
                header("Location: /login.php");
                exit();
            }

            try {
                // Kiểm tra tài khoản trong CSDL
                $query = "SELECT * FROM users WHERE email = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->execute([$email]);
                $user = $stmt->fetchAssociative(); // DBAL 3.x sử dụng fetchAssociative()

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_email'] = $user['email'];

                    // Chuyển hướng đến dashboard sau khi đăng nhập thành công
                    header("Location: /admin/dashboard.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Sai email hoặc mật khẩu!";
                    header("Location: /login.php");
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Lỗi hệ thống: " . $e->getMessage();
                header("Location: /login.php");
                exit();
            }
        }
    }
}

// Khởi tạo AuthController và xử lý đăng nhập
$authController = new AuthController($conn);
$authController->login();
