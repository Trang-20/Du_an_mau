
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{ $_ENV['BASE_URL'] }}/users/create">Add</a>
    <table table="2">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Age</th>
                <th>Emaiul</th>

                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['user_name'] }}</td>
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