<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<h1>$value</h1>";
                unset($_SESSION['errors']);
            }
        }
    @endphp
    
    <form action="{{ $_ENV['BASE_URL'] }}/products/store" method="post" enctype="multipart/form-data">
        <div>
            <label for="">Tên Sản phẩm</label>
            <input type="text" placeholder="Tên Sản phẩm" name="name" id="">
        </div>
        <div>
            <label for="">Danh mục Sản phẩm</label>
            <select name="category_id">
                @foreach($categories as $value)
                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Tên Người dùng</label>
            <select name="user_id">
                @foreach($users as $value)
                    <option value="{{ $value['id'] }}">{{ $value['user_namename'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Hình ảnh Sản phẩm</label>
            <input type="file" name="image" id="">  {{-- day file anh len:  enctype="multipart/form-data"--}}
        </div>
        <div>
            <label for="">Mô tả Sản phẩm</label>
            <textarea placeholder="Mô tả Sản phẩm" name="description"></textarea>
        </div>

        <button>Add Pro</button>
    </form>
{{--  --}}
</body>
</html>