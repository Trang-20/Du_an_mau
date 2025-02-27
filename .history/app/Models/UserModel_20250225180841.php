<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder;

class ProductModel extends Model 
{
public function getCategories() 
    {
        $stmt = $this->queryBuilder->select("c.*")
            ->from('categories', 'c'); //hiển thị tên danh mục
        return $stmt->fetchAllAssociative();    
    }