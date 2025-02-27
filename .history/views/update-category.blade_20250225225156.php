<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
  
    <form action="{{ $_ENV['BASE_URL'] }}categories/{{ $category['id']}}/update" method="post"
        enctype="multipart/form-data">
        <div>
            <label for="">Tên Danh mục</label>
            <input type="text" placeholder="Tên Danh mục" name="name" value="{{ $category['name'] }}">
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
