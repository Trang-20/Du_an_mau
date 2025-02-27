<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder;

class ProductModel extends Model 
{
                // 'user_id'           =>  $_POST['user_id'],

public function getUsers() 
    {
        $stmt = $this->queryBuilder->select("u.*")
            ->from('users', 'u'); //hiển thị tên danh mục
        return $stmt->fetchAllAssociative();    
    }

}