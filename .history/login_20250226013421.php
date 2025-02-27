<?php

session_start();  // Khởi tạo session

// Tải file .env để lấy thông tin cấu hình
require_once __DIR__ . '/vendor/autoload.php';  // Đảm bảo bạn đã cài đặt composer và autoload
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Lấy thông tin từ .env
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

// Kết nối với cơ sở dữ liệu MySQL bằng PDO
try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}

// Kiểm tra khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Nhận dữ liệu từ form
    $username = $_POST['username'];  // Dữ liệu từ form
    $password = $_POST['password'];  // Dữ liệu từ form
    $role = $_POST['role'] == "admin";

    // Truy vấn để lấy thông tin người dùng từ bảng users
    $stmt = $pdo->prepare("SELECT id, email, password, role  FROM users WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password && $role) {
        // Đăng nhập thành công, lưu thông tin vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['email'];

        // Chuyển hướng đến trang dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Nếu đăng nhập không thành công
        echo "Tên người dùng hoặc mật khẩu không đúng.";
    }
}

?>

<!-- Form đăng nhập -->
<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Tên người dùng" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
</form>
