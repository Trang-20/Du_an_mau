
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
    <h2>list-user.blade form</h2>


    <a href="{{ $_ENV['BASE_URL'] }}/users/create">Add</a>
    <table table="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>password</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['user_name'] }}</td>
                    <td>{{ $value['age'] }}</td>
                    <td>{{ $value['email'] }}</td>
                    <td>{{ $value['password'] }}</td>

                    <td>
                        <a href="{{ $_ENV['BASE_URL'] }}/users/{{ $value['id'] }}/edit">Edit</a>
                        <a href="{{ $_ENV['BASE_URL'] }}/users/{{ $value['id'] }}/delete"
                        onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    
</body>
</html>