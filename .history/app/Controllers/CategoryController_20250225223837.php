<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Rakit\Validation\Validator;  //validate

class CategoryController extends Controller 
{
    private $categoryModel;
    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        echo $this->blade->run("list-category", ["categories" => $categories]);
    //    echo "123";
    //    exit();
    }

    public function create() {
        $categories = $this->categoryModel->getCategories();
        echo $this->blade->run("add-category", ["categories" => $categories]);
    }

    public function store() {
        //validate
        $validator = new Validator;

        $validation = $validator->make([
            'name'      => $_POST['name'],
            'id'        => $_POST['id'],

        ], [
            'name'          => 'required|min:1|max:50',
            'id'   => 'required|integer',
           
        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . 'categories/create');
            exit();
        } 
        //end //validate

        //add
        $this->categoryModel->addCategory();
        header('Location: ' . $_ENV['BASE_URL'] . 'categories' );
    }

    public function edit($id)
    {
        $category = $this->categoryModel->findCategory($id);
    
        echo $this->blade->run("update-category", [
            "category" => $category, 
        ]);
    }
    
    public function update($id) 
    {  //validate 
        $validator = new Validator;

        $validation = $validator->make([
            'name'          => $_POST['name'],
            'id'            => $_POST['id'],
           
        ], [
            'name'          => 'required|min:1|max:50',
            'id'            => 'required|integer',
            'image'         => 'uploaded_file:0,2M,png,jpg,jpeg',
            'description'   => 'max:255'

        ]);

        $validation->validate();
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . $_ENV['BASE_URL'] . "categories/$id/edit");
            exit();
        } 
        //end validate

        //upload anh
        $category = $this->categoryModel->findCategory($id);
        $image = $_FILES['image'];
        $image_url = $category['img_thumbnail'];

        if($image['name'] != "") {
            unlink($image_url);
            $imageName = time(). "_" . $image['name'];
            move_uploaded_file($image['tmp_name'], "uploads/$imageName");
        
            $image_url = "uploads/$imageName";  
        }
        // end upload anh

        $this->categoryModel->updateCategory($id, $image_url);
        header('Location: ' . $_ENV['BASE_URL'] . 'categories' );
    
    }


    public function delete($id) 
    {
        //delete image
        $category = $this->categoryModel->findCategory($id);
        if($category['img_thumbnail'] != null ) {
            unlink($category['img_thumbnail']);
        }  //xoa anh tren uploads

        $this->categoryModel->deleteCategory($id);
        header('Location: ' . $_ENV['BASE_URL'] . 'categories' );
        //xoas tren categories
    }
   
}