<?php
session_start(); // Khởi tạo session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Nhận dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập (ví dụ so sánh với cơ sở dữ liệu)
    $username = 'admin';  // Tên người dùng đã lưu trong cơ sở dữ liệu (giả sử)
    $password = '$2y$10$KIX....';  // Mật khẩu đã mã hóa trong cơ sở dữ liệu (giả sử)
    $userId = 1;  // ID người dùng trong cơ sở dữ liệu (giả sử)

    if ($username == $storedUsername && password_verify($password, $storedPasswordHash)) {
        // Đăng nhập thành công, lưu thông tin vào session
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;

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
