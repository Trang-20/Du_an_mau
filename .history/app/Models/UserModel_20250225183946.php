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

    public function addProduct($image_url)
    {
        
        $now = date('Y-m-d H:i:s');
        $stmt = $this->queryBuilder->insert("products")
        ->values([
            'category_id'       =>  ':category_id',
            'name'              =>  ':name',
            'img_thumbnail'     =>  ':img_thumbnail',
            'description'       =>  ':description',
            'create_at'         =>  ':create_at	',
            'update_at'         =>  ':update_at',

        ])
        ->setParameters([
            'category_id'       =>  $_POST['category_id'],
            'name'              =>  $_POST['name'],
            'img_thumbnail'     =>  $image_url,
            'description'       =>  $_POST['description'],
            'create_at'         =>  $now,
            'update_at'         =>  $now,
        ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }
}