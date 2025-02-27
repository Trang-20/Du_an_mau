<?php


//-------------

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
        echo $this->blade->run("list-u", ["us" => $us]);
       
    }
//--------
    public function create() {
        $categories = $this->uModel->getCategories();
        echo $this->blade->run("add-u", ["categories" => $categories]);
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
            'description'   => 'max:255'

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'us/create');
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
        $this->uModel->addUser($image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'us' );
    }

    public function edit($id)
    {
        $categories = $this->uModel->getCategories();
        $u = $this->uModel->findUser($id);
    
        echo $this->blade->run("update-u", [
            "categories" => $categories,
            "u" => $u,
            
        ]);

    }
    
    public function update($id) 
    {
        //validate 
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
            'description'   => 'max:255'

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . "us/$id/edit");
            exit();
        } 
        //end //validate


        //upload anh
        $u = $this->uModel->findUser($id);
        $image = $_FILES['image'];
        $image_url = $u['img_thumbnail'];

        if($image['name'] != "") {
            unlink($image_url);
            $imageName = time(). "_" . $image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
        
            $image_url = "uploads/$imageName";  
        }
        // end upload anh
        $this->uModel->updateUser($id, $image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'us' );
    
    }


    public function delete($id) 
    {
        //delete image
        $u = $this->uModel->findUser($id);
        if($u['img_thumbnail'] != null ) {
            unlink($u['img_thumbnail']);
        }  //xoa anh tren uploads


        $this->uModel->deleteUser($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'us' );
        //xoas tren u user
    }
   
}