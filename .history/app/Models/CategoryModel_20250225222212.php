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

    public function addProduct()
    {
        $stmt = $this->queryBuilder->insert("products")
        ->values([
            'category_id'       =>  ':category_id',
            'name'              =>  ':name',
        
        ])
        ->setParameters([
            'category_id'       =>  $_POST['category_id'],
            'name'              =>  $_POST['name'],
            
        ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }

    public function deleteCategory($id) 
    {
        $stmt = $this->queryBuilder->delete('categories')
            ->where('id = :id')
            ->setParameters(['id' => $id]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }

    public function findCategory($id) 
    {
        $stmt = $this->queryBuilder->select("p.*")
            ->from('categories' , 'c')
            ->where("c.id = :id")
            ->setParameters(['id' => $id]);

        return $stmt->fetchAssociative();
    }

    public function updateCategory($id, $image_url)  
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