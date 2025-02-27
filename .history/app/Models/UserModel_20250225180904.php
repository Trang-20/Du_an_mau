<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder;

class ProductModel extends Model 
{
public function getUsers() 
    {
        $stmt = $this->queryBuilder->select("u.*")
            ->from('users', 'c'); //hiển thị tên danh mục
        return $stmt->fetchAllAssociative();    
    }

}