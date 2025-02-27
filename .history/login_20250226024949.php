<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php'; 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}

$error_message = ""; // Biến để chứa thông báo lỗi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  
    $password = $_POST['password'];  

    $stmt = $pdo->prepare("SELECT id, email, password, role FROM users WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password']) && $user['role'] == 'admin') {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['email'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = "Tên người dùng, mật khẩu không đúng hoặc bạn không phải là admin.";
    }
}
?>

<!-- Form đăng nhập -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <style>
        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
            }

    
    </style>
    
<form method="POST" action="login.php">
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <input type="text" name="username" placeholder="Tên người dùng" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng nhập</button>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
</form>

</body>
 </html>