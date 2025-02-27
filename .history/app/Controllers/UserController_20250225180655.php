<?php

namespace App\Controllers;

// use App\Models\ProductModel;
// use Rakit\Validation\Validator;  //validate

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->usserModel = new ProductModel();
    }

    public function index() {
        echo "hi";
    }
}