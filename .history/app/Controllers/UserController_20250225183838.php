<?php
namespace App\Controllers;

use App\Models\UserModel;
use Rakit\Validation\Validator;  //validate

class UserController extends Controller 
{
    private $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }



    public function index() {
        $users = $this->userModel->getUsers();
        echo $this->blade->run("list-user", ["users" => $users]);
    }


    public function store() {
        //validate
        $validator = new Validator;

        $validation = $validator->make([
            'user_name'     => $_POST['user_name'],
            'age'           => $_POST['age'],
            'email'         => $_FILES['email'],
            'password'      => $_POST['password'],

        ], [
            'user_name'   => 'required|min:1|max:50',
            'age'         => 'required|integer',
            'email'       => 'uploaded_file:0,2M,png,jpg,jpeg',
            'password'    => 'max:255',

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'users/create');
            exit();
        } 
        //end //validate

        //add
        $this->userModel->addUser($image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'users' );
    }
}