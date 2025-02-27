<?php
namespace App\Controllers;

require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

// require_once __DIR__ . '/app/Common/Database.php';

use eftec\bladeone\BladeOne;
use Doctrine\DBAL\Connection;



class AuthController {
    private $pdo;
    protected $blade;

    public function __construct($pdo) {
        $this->pdo = $pdo;
         
            $views = __DIR__ . '/../../views'; // Đường dẫn chính xác đến thư mục views
            $cache = __DIR__ . '/../../cache'; // Thư mục cache

            $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // Bật debug để kiểm tra lỗi
            $blade->setBaseUrl('/'); // Đặt base URL nếu cần

            echo $blade->run("auth.login");

            // echo "BladeOne Views Path: " . $views; // Debug đường dẫn
            // exit();
            // echo "BladeOne Views Path: " . realpath($views);
            // exit();
            
    }
    public function login() {
    
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  
    $password = $_POST['password'];  

        $stmt = $pdo->prepare("SELECT id, email, password, role FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password == $user['password'] && $user['role'] === 'admin') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['email'];
            $_SESSION['password'] = $user['password'];

            header('Location: dashboard.php');
            exit;
        } else {
            echo "Tên người dùng, mật khẩu không đúng hoặc bạn không phải là admin.";
        }
    }
        }

    public function showLoginForm() {
        echo $this->blade->run('auth.login'); // Gọi đúng template
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
