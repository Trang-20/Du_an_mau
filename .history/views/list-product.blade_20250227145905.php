
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>


<div class="container mt-3">
    <h2>Stacked form</h2>
    
    <div>  <input type="text" name="search" placeholder="Nhập tên sản phẩm..." value="{{ $_GET['search'] ?? '' }}">
        <button type="submit">Tìm kiếm</button></div>
    <a class="my-2 btn btn-primary " href="{{ $_ENV['BASE_URL'] }}/products/create">Ad Prd</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Name</th>
                <th>Image</th>
                <th>Create At</th>
                <th>Update At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['categoryName'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>
                        @if($value['img_thumbnail'] != null)
                            <img width="100px" src="{{ $_ENV['BASE_URL'] . $value['img_thumbnail'] }}">
                        @endif
                    </td>
                    <td>{{ date('d/m/y H:i:s', strtotime($value['create_at'])) }}</td>
                    <td>{{ date('d/m/y H:i:s', strtotime($value['update_at']))}}</td>
                    <td>
                        <a class="my-2 btn btn-warning"  href="{{ $_ENV['BASE_URL'] }}/products/{{ $value['id'] }}/edit">Edit</a>
                        <a class="my-2 btn btn-danger" href="{{ $_ENV['BASE_URL'] }}/products/{{ $value['id'] }}/delete"
                        onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    
</body>
</html>