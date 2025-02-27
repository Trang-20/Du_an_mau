<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Rakit\Validation\Validator;  //validate

class UserController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function index() {
        echo "hi";
    }
}