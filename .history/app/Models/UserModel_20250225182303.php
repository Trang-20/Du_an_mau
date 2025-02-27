<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder;

class UserModel extends Model 
{
public function getUsers() 
    {
        $stmt = $this->queryBuilder->select("u.*")
            ->from('users', 'u') //hiển thị tên danh mục
            ->orderby('u.id', 'desc'); //hiển thị theo thứ tự id giảm dần
        
            return $stmt->fetchAllAssociative();    
    }

}