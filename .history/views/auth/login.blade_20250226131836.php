<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7fc; text-align: center; }
        .login-container { background-color: #fff; padding: 20px; width: 300px; margin: 100px auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, button { width: 100%; padding: 10px; margin: 5px 0; }
        button { background-color: #007bff; color: #fff; border: none; cursor: pointer; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        @if(isset($error))
            <p class="error">{{ $error }}</p>
        @endif
        <form method="POST" action="/auth/login">
            <input type="text" name="username" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
