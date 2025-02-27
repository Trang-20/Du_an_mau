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
      <h2>Update Product form</h2>
        
  
    <form action="{{ $_ENV['BASE_URL'] }}products/{{ $product['id']}}/update" method="post"
        enctype="multipart/form-data">
        <div>
            <label for="">Tên Sản phẩm</label>
            <input class="form-control" type="text" placeholder="Tên Sản phẩm" name="name" value="{{ $product['name'] }}">
        </div>
        <div>
            <label for="">Danh mục Sản phẩm</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $value)
                    <option 
                        @if ($product['category_id'] == $value['id']) 
                            selected 
                        @endif 
                            value="{{ $value['id'] }}">
                                {{ $value['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Hình ảnh Sản phẩm</label>
            @if($product['img_thumbnail'] != null)
                <img width="100" src="{{ $_ENV['BASE_URL'] . $product['img_thumbnail'] }}">
            @endif
            <input class="form-control" type="file" name="image" id=""> {{-- day file anh len:  enctype="multipart/form-data" --}}
        </div>
        <div>
            <label for="">Mô tả Sản phẩm</label>
            <textarea class="form-control" placeholder="Mô tả Sản phẩm" name="description">{{ $product['description'] }}</textarea>
        </div>
        @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<h1>$value</h1>";
                unset($_SESSION['errors']);
            }
        }
        @endphp
        <button  class="my-3 btn btn-primary">Update Pro</button>
    </form>
</body>

</html>
