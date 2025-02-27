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
        echo $this->blade->run("list-product", ["products" => $products]);
       
    }
//--------
    public function create() {
        $categories = $this->productModel->getCategories();
        echo $this->blade->run("add-product", ["categories" => $categories]);
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
        $this->productModel->addUser($image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'products' );
    }

    public function edit($id)
    {
        $categories = $this->productModel->getCategories();
        $product = $this->productModel->findUser($id);
    
        echo $this->blade->run("update-product", [
            "categories" => $categories,
            "product" => $product,
            
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
            header('Location: ' . $_ENV['BASE_URL'] . "products/$id/edit");
            exit();
        } 
        //end //validate


        //upload anh
        $product = $this->productModel->findUser($id);
        $image = $_FILES['image'];
        $image_url = $product['img_thumbnail'];

        if($image['name'] != "") {
            unlink($image_url);
            $imageName = time(). "_" . $image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
        
            $image_url = "uploads/$imageName";  
        }
        // end upload anh
        $this->productModel->updateUser($id, $image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'products' );
    
    }


    public function delete($id) 
    {
        //delete image
        $product = $this->productModel->findUser($id);
        if($product['img_thumbnail'] != null ) {
            unlink($product['img_thumbnail']);
        }  //xoa anh tren uploads


        $this->productModel->deleteProduct($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'products' );
        //xoas tren product
    }
   
}