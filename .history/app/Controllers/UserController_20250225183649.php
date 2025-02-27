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
            'name'          => $_POST['name'],
            'category_id'   => $_POST['category_id'],
            'image'         => $_FILES['image'],
            'description'   => $_POST['description'],

        ], [
            'name'          => 'required|min:1|max:50',
            'category_id'   => 'required|integer',
            'image'         => 'uploaded_file:0,2M,png,jpg,jpeg',
            'description'   => 'max:255',

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'products/create');
            exit();
        } 
        //end //validate

        //upload anh
        $image = $_FILES['image'];
        $image_url = null;

        if($image['name'] != "") {
            $imageName = time(). "_" . $image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
        
            $image_url = "uploads/$imageName";

        }
         //end   upload anh

        //add
        $this->userModel->addProduct($image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'products' );
    }
}