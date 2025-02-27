<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
  
    <form action="{{ $_ENV['BASE_URL'] }}products/{{ $product['id']}}/update" method="post"
        enctype="multipart/form-data">
        <div>
            <label for="">Tên Sản phẩm</label>
            <input type="text" placeholder="Tên Sản phẩm" name="name" value="{{ $product['name'] }}">
        </div>
        <div>
            <label for="">Danh mục Sản phẩm</label>
            <select name="category_id">
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
            <input type="file" name="image" id=""> {{-- day file anh len:  enctype="multipart/form-data" --}}
        </div>
        <div>
            <label for="">Mô tả Sản phẩm</label>
            <textarea placeholder="Mô tả Sản phẩm" name="description">{{ $product['description'] }}</textarea>
        </div>

        <button>Update Pro</button>
    </form>
</body>

</html>
