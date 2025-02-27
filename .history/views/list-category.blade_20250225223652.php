
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ $_ENV['BASE_URL'] }}/categories/create">Add</a>
    <table table="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['categoryName'] }}</td>
                 
                    <td>
                        @if($value['img_thumbnail'] != null)
                            <img width="100px" src="{{ $_ENV['BASE_URL'] . $value['img_thumbnail'] }}">
                        @endif
                    </td>
                    <td>{{ date('d/m/y H:i:s', strtotime($value['create_at'])) }}</td>
                    <td>{{ date('d/m/y H:i:s', strtotime($value['update_at']))}}</td>
                    <td>
                        <a href="{{ $_ENV['BASE_URL'] }}/categories/{{ $value['id'] }}/edit">Edit</a>
                        <a href="{{ $_ENV['BASE_URL'] }}/categories/{{ $value['id'] }}/delete"
                        onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    
</body>
</html>