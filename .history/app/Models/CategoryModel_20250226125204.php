<?php

namespace App\Models;

use Doctrine\DBAL\Query;
use Doctrine\DBAL\Query\QueryBuilder;

class CategoryModel extends Model 
{
    public function getCategories() 
    {
        $stmt = $this->queryBuilder->select('c.*')
            ->from('categories', 'c') //hiển thị tên danh mục
            ->orderby('c.id', 'desc'); //hiển thị theo thứ tự id giảm dần
        return $stmt->fetchAllAssociative();    
    }

    public function addCategory()
    {
        // $user_id = $_SESSION['user_id'] ?? null; // Lấy user_id từ session hoặc mặc định null
        $stmt = $this->queryBuilder->insert("categories")
        ->values([
            // 'user_id'  => ':user_id',  // Thêm user_id vào truy vấn
            'id'       =>  ':id',
            'name'     =>  ':name',
        
        ])
        ->setParameters([
            // 'user_id'  => $user_id,  // Truyền giá trị user_id
            'id'       =>  $_POST['id'],
            'name'     =>  $_POST['name'],
            
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
        $stmt = $this->queryBuilder->select("c.*")
            ->from('categories' , 'c')
            ->where("c.id = :id")
            ->setParameters(['id' => $id]);

        return $stmt->fetchAssociative();
    }

    public function updateCategory($id)  
    {
        $stmt = $this->queryBuilder->update("categories")
            ->set('name'         ,  ":name")  
            ->where("id = :id")
            ->setParameters([
                'name'     =>  $_POST['name'],
                'id'       =>  $id,
            ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
       }
    }