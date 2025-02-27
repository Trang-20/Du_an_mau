<?php

namespace App\Controllers;

use eftec\bladeone\BladeOne;

class AuthController {
    protected $blade;

    public function __construct() {
        $views = __DIR__ . '/../../views';
        $cache = __DIR__ . '/../../cache';
        
        // Gán vào biến class để dùng trong các function khác
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
    
    }
}

