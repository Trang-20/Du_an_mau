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

    // Truy vấn để lấy thông tin người dùng từ bảng users
    $stmt = $pdo->prepare("SELECT id, email, password, role  FROM users WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password && $user['role'] == 'admin' ) {
        // Đăng nhập thành công, lưu thông tin vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['email'];

        // Chuyển hướng đến trang dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Nếu đăng nhập không thành công
        echo "Tên người dùng, mật khẩu không đúng hoặc bạn không phải là admin.";
    }
}

?>

<!-- Form đăng nhập -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }
        .form-group input:focus {
            border-color: #667eea;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: #764ba2;
        }
        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
        }
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        
        <!-- <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Tên người dùng" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form> -->

        <form action="/login" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p class="forgot-password"><a href="?">Forgot your password?</a></p>
    </div>
</body>
</html>
