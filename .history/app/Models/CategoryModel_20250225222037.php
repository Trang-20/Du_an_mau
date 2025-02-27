<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder;

class CategoryModel extends Model 
{
    public function getCategories() 
    {
        $stmt = $this->queryBuilder->select("c.*")
            ->from('categories', 'c'); //hiển thị tên danh mục
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

    public function deleteProduct($id) 
    {
        $stmt = $this->queryBuilder->delete('products')
            ->where('id = :id')
            ->setParameters(['id' => $id]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }

    public function findProduct($id) 
    {
        $stmt = $this->queryBuilder->select("p.*")
            ->from('products' , 'p')
            ->where("p.id = :id")
            ->setParameters(['id' => $id]);

        return $stmt->fetchAssociative();
    }

    public function updateProduct($id, $image_url)  
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->queryBuilder->update("products")
            ->set('category_id'     ,  ":category_id")
            ->set('name'            ,  ":name")
            ->set('img_thumbnail'   ,  ":img_thumbnail")
            ->set('description'     ,  ":description")
            ->set('update_at'       ,  ":update_at")     
            ->where("id = :id")
            ->setParameters([
                'category_id'       =>  $_POST['category_id'],
                'name'              =>  $_POST['name'],
                'img_thumbnail'     =>  $image_url,
                'description'       =>  $_POST['description'],
                'update_at'         =>  $now,
                'id'                =>  $id,
            ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
       }
    }