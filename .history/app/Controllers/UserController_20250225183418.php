<?php
namespace App\Controllers;

use App\Models\UserModel;
use Rakit\Validation\Validator;  //validate

class ProductController extends Controller 
{
    private $productModel;
    public function __construct()
    {
        parent::__construct();
        $this->productModel = new ProductModel();
    }
