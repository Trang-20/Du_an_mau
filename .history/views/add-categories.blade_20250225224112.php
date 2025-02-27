<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    
    
    <form action="{{ $_ENV['BASE_URL'] }}/categories/store" method="post">
        <div>
            <label for="">Tên Danh mục</label>
            <input type="text" placeholder="Tên Danh mục" name="name" id="">
        </div>
       
        @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<strong>$value</strong>";
                unset($_SESSION['errors']);
            }
        }
        @endphp

        <button>Add Cate</button>
    </form>
{{--  --}}
</body>
</html>