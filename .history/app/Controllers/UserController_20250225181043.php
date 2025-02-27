<?php

namespace App\Controllers;

use App\Models\ProductModel;
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
        $products = $this->userModel->getUsers();
        echo $this->blade->run("list-product", ["products" => $products]);
      }
}