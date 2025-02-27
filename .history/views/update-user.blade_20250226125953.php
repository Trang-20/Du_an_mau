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
        
  
    <form action="{{ $_ENV['BASE_URL'] }}users/{{ $users['id']}}/update" method="post">
        <input  class="form-control" type="hidden" name="id" value="<?= $user['id'] ?>">

        <div>
            <label for="">User Name</label>
            <input  class="form-control" type="text" placeholder="User Name" name="user_name" value="{{ $user['user_name'] }}">
        </div>

        <div>
            <label for="">Age</label>
            <input  class="form-control" type="number" placeholder="Age" name="age" value="{{ $user['age'] }}">
        </div>

        <div>
            <label for="">Email</label>
            <input  class="form-control" type="email" placeholder="Email" name="email" value="{{ $user['email'] }}">
        </div>

        <div>
            <label for="">Password</label>
            <input  class="form-control" type="text" placeholder="Password" name="password" value="{{ $user['password'] }}">
        </div>
       
        <div>
            <label for="">Role</label>
            <input  class="form-control" type="text" placeholder="Role" name="password" value="{{ $user['password'] }}">
        </div>

        @php
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $value) {
                echo "<h1>$value</h1>";
                unset($_SESSION['errors']);
            }
        }
        @endphp
        <button  class=" mt-3 btn btn-primary">Update User</button>
    </form>
</body>

</html>
