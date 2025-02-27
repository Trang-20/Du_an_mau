<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
  
    <form action="{{ $_ENV['BASE_URL'] }}users/{{ $users['id']}}/update" method="post">
        <div>
            <label for="">User Name</label>
            <input type="text" placeholder="User Name" name="user_name" value="{{ $user['user_name'] }}">
        </div>

        <div>
            <label for="">Age</label>
            <input type="number" placeholder="Age" name="age" value="{{ $user['age'] }}">
        </div>

        <div>
            <label for="">Email</label>
            <input type="email" placeholder="Email" name="mail" value="{{ $user['user_name'] }}">
        </div>

        <div>
            <label for="">Password</label>
            <input type="text" placeholder="User Name" name="user_name" value="{{ $user['user_name'] }}">
        </div>
       

        @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<h1>$value</h1>";
                unset($_SESSION['errors']);
            }
        }
        @endphp
        <button>Update Pro</button>
    </form>
</body>

</html>
