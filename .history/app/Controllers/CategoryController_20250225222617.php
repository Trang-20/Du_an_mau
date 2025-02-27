<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use Rakit\Validation\Validator;  //validate

class CategoryController extends Controller 
{
    // private $categoryModel;
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->categoryModel = new CategoriesModel();
    // }

    public function index() {
        $categories = $this->categoryModel->getCategories();
        echo $this->blade->run("list-category", ["categories" => $categories]);
    //    echo "123";
    //    exit();
    }

//     public function create() {
//         $categories = $this->categoryModel->getCategories();
//         echo $this->blade->run("add-category", ["categories" => $categories]);
//     }

//     public function store() {
//         //validate
//         $validator = new Validator;

//         $validation = $validator->make([
//             'name'          => $_POST['name'],
//             'category_id'   => $_POST['category_id'],
//             'image'         => $_FILES['image'],
//             'description'   => $_POST['description'],

//         ], [
//             'name'          => 'required|min:1|max:50',
//             'category_id'   => 'required|integer',
//             'image'         => 'uploaded_file:0,2M,png,jpg,jpeg',
//             'description'   => 'max:255',

//         ]);

//         $validation->validate();
//         if ($validation->fails()) {
//             $_SESSION['errors'] = $validation->errors()->firstOfAll();
//             header('Location: ' . $_ENV['BASE_URL'] . 'categories/create');
//             exit();
//         } 
//         //end //validate

//         //upload anh
//         $image = $_FILES['image'];
//         $image_url = null;

//         if($image['name'] != "") {
//             $imageName = time(). "_" . $image['name'];
//             move_uploaded_file($image['tmp_name'], "uploads/$imageName");

//             $image_url = "uploads/$imageName";
//         }
//          //end   upload anh

//         //add
//         $this->categoryModel->addCategory($image_url);
//         header('Location: ' . $_ENV['BASE_URL'] . 'categories' );
//     }

//     public function edit($id)
//     {
//         $categories = $this->productModel->getCategories();
//         $product = $this->productModel->findProduct($id);
    
//         echo $this->blade->run("update-product", [
//             "categories" => $categories,
//             "product" => $product, 
//         ]);
//     }
    
//     public function update($id) 
//     {  //validate 
//         $validator = new Validator;

//         $validation = $validator->make([
//             'name'          => $_POST['name'],
//             'category_id'   => $_POST['category_id'],
//             'image'         => $_FILES['image'],
//             'description'   => $_POST['description'],

//         ], [
//             'name'          => 'required|min:1|max:50',
//             'category_id'   => 'required|integer',
//             'image'         => 'uploaded_file:0,2M,png,jpg,jpeg',
//             'description'   => 'max:255'

//         ]);

//         $validation->validate();
//         if ($validation->fails()) {
//             $_SESSION['errors'] = $validation->errors()->firstOfAll();
//             header('Location: ' . $_ENV['BASE_URL'] . "categories/$id/edit");
//             exit();
//         } 
//         //end validate

//         //upload anh
//         $category = $this->categoryModel->findCategory($id);
//         $image = $_FILES['image'];
//         $image_url = $category['img_thumbnail'];

//         if($image['name'] != "") {
//             unlink($image_url);
//             $imageName = time(). "_" . $image['name'];
//             move_uploaded_file($image['tmp_name'], "uploads/$imageName");
        
//             $image_url = "uploads/$imageName";  
//         }
//         // end upload anh

//         $this->categoryModel->updateCcategory($id, $image_url);
//         header('Location: ' . $_ENV['BASE_URL'] . 'categories' );
    
//     }


//     public function delete($id) 
//     {
//         //delete image
//         $category = $this->categoryModel->findProduct($id);
//         if($product['img_thumbnail'] != null ) {
//             unlink($product['img_thumbnail']);
//         }  //xoa anh tren uploads

//         $this->productModel->deleteProduct($id);
//         header('Location: ' . $_ENV['BASE_URL'] . 'categories' );
//         //xoas tren product
//     }
   
}