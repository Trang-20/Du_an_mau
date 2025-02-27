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
            'user_name'   =>  ':user_name',
            'age'         =>  ':age',
            'email'       =>  ':email',
            'password'    =>  ':password',

        ])
        ->setParameters([
            'user_name'     => $_POST['user_name'],
            'age'           => $_POST['age'],
            'email'         => $_POST['email'],
            'password'      => $_POST['password'],
        ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }



    public function deleteUser($id) 
    {
        $stmt = $this->queryBuilder->delete('users')
            ->where('id = :id')
            ->setParameters(['id' => $id]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
    }

    public function findUser($id) 
    {
        $stmt = $this->queryBuilder->select("u.*")
            ->from('users' , 'u')
            ->where("u.id = :id")
            ->setParameters(['id' => $id]);

        return $stmt->fetchAssociative();
    }
    public function updateUser($id, $image_url)  
    {

        $now = date('Y-m-d H:i:s');
        $stmt = $this->queryBuilder->update("users")
            ->set('user_name'     ,  ":user_name")
            ->set('age'           ,  ":age")
            ->set('email'         ,  ":email")
            ->set('password'      ,  ":password")
            ->where("id = :id")
            ->setParameters([
                'user_name'      =>  $_POST['user_name'],
                'age'            =>  $_POST['age'],
                'email'          =>  $_POST['email'],
                'password'       =>  $_POST['password'],
                'id'                =>  $id,

            ]);
        $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
       }
    }