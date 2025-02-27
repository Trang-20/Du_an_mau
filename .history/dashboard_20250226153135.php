
<?php
session_start(); // Khởi tạo session
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    </head>
    <body>
    <div class="container mt-3">

    <br>
    <h1>Dashboard</h1>

        <?php
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['user_id'])) {
            // Người dùng đã đăng nhập
            echo "Chào, " . $_SESSION['username'];  // Hiển thị tên người dùng
            // header('Location: list-product');
            $productUrl = $baseUrl . "../products/";
        ?>
        <br>
        <div class="mb-3 mt-3">           

        <a href="http://localhost/asm2C/products/" >Xem Danh sách sản phẩm</a> <br>
        <a href="http://localhost/asm2C/users/" >Xem Danh sách User</a> <br>
        <a href="http://localhost/asm2C/categories/" >Xem Danh sách danh mục</a>

        <a href='logout.php'>Đăng xuất</a>
        </div>
        </div>
    </body>
    </html>

<?php
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit;
}
?>


