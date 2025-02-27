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

    public function addUser()
    {
        $stmt = $this->queryBuilder->insert("users")
        ->values([
            'user_name'         =>  ':user_name',
            'age'               =>  ':age',
            'email'             =>  ':email',
            'password'          =>  ':password',

        ])
        ->setParameters([
            'user_name'     => $_POST['user_name'],
            'age'           => $_POST['age'],
            'email'         => $_FILES['email'],
            'password'      => $_POST['password'],
        ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }


    public function findUser($id) 
    {
        $stmt = $this->queryBuilder->select("p.*")
            ->from('products' , 'p')
            ->where("p.id = :id")
            ->setParameters(['id' => $id]);

        return $stmt->fetchAssociative();
    }
}