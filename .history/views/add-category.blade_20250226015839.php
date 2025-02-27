<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>
<div class="container mt-3">
  <h2>Add Category form</h2>
    
    <form action="{{ $_ENV['BASE_URL'] }}/categories/store" method="post">
        <div class="mb-3 mt-3">           
            <label for="">Tên Danh mục</label>
            <input class="form-control" type="text" placeholder="Tên Danh mục" name="name" id="">
        </div>
       
        @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<strong>$value</strong>";
                unset($_SESSION['errors']);
            }
        }
        @endphp

        <button >Add Cate</button>
    </form>
{{--  --}}
</body>
</html>