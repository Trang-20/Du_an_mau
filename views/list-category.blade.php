
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
    <style>
        .login-form {
            display: none;
        }

    </style>
    <div class="container mt-3">

        <h2>List Category form</h2>

    <a class="btn btn-primary my-3" href="{{ $_ENV['BASE_URL'] }}/categories/create">Add</a>
    <table class="table table-striped">
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
                    <td>{{ $value['name'] }}</td>
            
                    <td>
                        <a class="btn btn-warning" href="{{ $_ENV['BASE_URL'] }}/categories/{{ $value['id'] }}/edit">Edit</a>
                        <a class="btn btn-danger" href="{{ $_ENV['BASE_URL'] }}/categories/{{ $value['id'] }}/delete"
                        onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    
</body>
</html>