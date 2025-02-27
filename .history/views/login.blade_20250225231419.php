<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Đăng Nhập Admin</h2>

    @if($error)
        <p style="color: red;">{{ $error }}</p>
    @endif

    <form action="/login" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Đăng Nhập</button>
    </form>
</body>
</html>
