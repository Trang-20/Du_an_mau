
<?php
session_start(); // Khởi tạo session

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    // Người dùng đã đăng nhập
    echo "Chào, " . $_SESSION['username'];  // Hiển thị tên người dùng
    // header('Location: list-product');
    $productUrl = $baseUrl . "/products/";
    ?>
    <!-- <a href="{{ $_ENV['BASE_URL'] }}/products/">Xem Danh sách sản phẩm</a> -->
    
    <a href="  $productUrl; ?>">Xem Danh sách sản phẩm</a>

<?php
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit;
}
?>
