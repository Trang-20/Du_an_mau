<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    
    
    <form action="{{ $_ENV['BASE_URL'] }}/users/store" method="post" >
        <div>
            <label for="">User Name</label>
            <input type="text" placeholder="User Name" name="user_name" id="">
        </div>
        <div>
            <label for="">Age</label>
            <input type="number" placeholder="Age" name="age" id="">
        </div>
        
        <div>
            <label for="">Email</label>
            <input type="email" name="email" id=""> 
        </div>
        <div>
            <label for="">Password</label>
            <input placeholder="Password" name="password">
        </div>
        @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<strong>$value</h1>";
                unset($_SESSION['errors']);
            }
        }
        @endphp
        <button>Add Pro</button>
    </form>
{{--  --}}
</body>
</html>