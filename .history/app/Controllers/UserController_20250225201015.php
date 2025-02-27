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

    public function create() {
        $users = $this->userModel->getUsers();
        echo $this->blade->run("add-user", ["users" => $users]);
    }

    public function store() {
        //validate
        $validator = new Validator;

        $validation = $validator->make([
            'user_name'     => $_POST['user_name'],
            'age'           => $_POST['age'],
            'email'         => $_POST['email'],
            'password'      => $_POST['password'],

        ], [
            'user_name'   => 'required|min|max:50',
            'age'         => 'required|integer',
            'email'       => 'required|email',
            'password'    => 'required|min:50|max:50',

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'users/create');
            exit();
        } 
        //end //validate

        //add
        $this->userModel->addUser();
        header('Location: ' . $_ENV['BASE_URL'] . 'users' );
    }


    public function edit($id)
    {
        $user = $this->userModel->findUser($id);
    
        echo $this->blade->run("update-user", [
            "user" => $user,
        ]);
    }

    public function update($id) 
    {  //validate 
        $validator = new Validator;

        $validation = $validator->make([
            'user_name'     => $_POST['user_name'],
            'age'           => $_POST['age'],
            'email'         => $_POST['email'],
            'password'      => $_POST['password'],

        ], [
            'user_name'          => 'required|min:1|max:50',
            'age'           => 'required|integer',
            'email'         => 'required|email',
            'password'      => 'required|min:1|max:50'

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . "users/$id/edit");
            exit();
        } 
        //end validate

        $this->userModel->updateUser($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'users' );
    
    }


    public function delete($id) 
    {
        //delete image
        $user = $this->userModel->findUser($id);
        if($user['img_thumbnail'] != null ) {
            unlink($user['img_thumbnail']);
        }  //xoa anh tren uploads


        $this->userModel->deleteUser($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'users' );
        //xoas tren user
    }

}