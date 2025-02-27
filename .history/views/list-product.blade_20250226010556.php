
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start(); // Khởi tạo session

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['user_id'])) {
    // Người dùng đã đăng nhập
    echo "Chào, " . $_SESSION['username'];  // Hiển thị tên người dùng
    
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: login.php');
    exit;
}
    <a href="{{ $_ENV['BASE_URL'] }}/products/create">Add</a>
    <table table="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Image</th>
                <th>Create At</th>
                <th>Update At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['categoryName'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>
                        @if($value['img_thumbnail'] != null)
                            <img width="100px" src="{{ $_ENV['BASE_URL'] . $value['img_thumbnail'] }}">
                        @endif
                    </td>
                    <td>{{ date('d/m/y H:i:s', strtotime($value['create_at'])) }}</td>
                    <td>{{ date('d/m/y H:i:s', strtotime($value['update_at']))}}</td>
                    <td>
                        <a href="{{ $_ENV['BASE_URL'] }}/products/{{ $value['id'] }}/edit">Edit</a>
                        <a href="{{ $_ENV['BASE_URL'] }}/products/{{ $value['id'] }}/delete"
                        onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    
</body>
</html>