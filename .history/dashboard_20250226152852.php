
<?php
session_start(); // Khởi tạo session

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    // Người dùng đã đăng nhập
    echo "Chào, " . $_SESSION['username'];  // Hiển thị tên người dùng
    // header('Location: list-product');
    $productUrl = $baseUrl . "../products/";
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <br>
    <h1></h1>
        <a href="http://localhost/asm2C/products/" >Xem Danh sách sản phẩm</a> <br>
        <a href="http://localhost/asm2C/users/" >Xem Danh sách User</a> <br>
        <a href="http://localhost/asm2C/categories/" >Xem Danh sách danh mục</a>

        <a href='logout.php'>Đăng xuất</a>

    </body>
    </html>

<?php
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit;
}
?>


