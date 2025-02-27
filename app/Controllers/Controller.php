<?php

namespace App\Controllers;
use eftec\bladeone\BladeOne;


class Controller{
    protected $blade;
    public function __construct()
    {
        $views = ROOT_PATH . '/views';    //đương dẫn đến thư mục
        $cache = ROOT_PATH . '/cache';  // ROOT_PATH khai báo ở index

        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }
}