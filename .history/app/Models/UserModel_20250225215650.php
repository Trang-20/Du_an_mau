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

   
    // public function findUser($id) 
    // {
    //     try {
    //     $stmt = $this->queryBuilder->select("p.*")
    //         ->from('users' , 'p')
    //         ->where("p.id = :id")
    //         ->setParameter(['id' => $id]);

    //         $result = $this->connection->executeQuery($stmt->getSQL(), $stmt->getParameters())->fetchAssociative();

    //         if (!$result) {
    //             die(" Không tìm thấy user với ID: " . $id);
    //         }
    
    //         return $result;
    //     } catch (\Exception $e) {
    //         die(" Lỗi SQL: " . $e->getMessage());
    //     }
    // }
    public function findUser($id) 
    {
        try {
            $stmt = $this->queryBuilder->select("p.*")
                ->from('users', 'p')
                ->where(".id = :id")
                ->setParameter('id', $id); // ✅ Sử dụng setParameter đúng cách
    
            // Debug SQL
            echo "🔍 SQL Query: " . $stmt->getSQL();
            echo "<br>🔍 Parameters: ";
            print_r($stmt->getParameters());
    
            // Chạy truy vấn
            $result = $this->connection->executeQuery($stmt->getSQL(), $stmt->getParameters())->fetchAssociative();
    
            if (!$result) {
                die("❌ Không tìm thấy user với ID: " . $id);
            }
    
            return $result;
        } catch (\Exception $e) {
            die("❌ Lỗi SQL: " . $e->getMessage());
        }
    }
    
    


    // public function updateUser($id)  
    // {
    //     $stmt = $this->queryBuilder->update("users")
    //         ->set('user_name'     ,  ":user_name")
    //         ->set('age'           ,  ":age")
    //         ->set('email'         ,  ":email")
    //         ->set('password'      ,  ":password")     
    //         ->where("id = :id")
    //         ->setParameters([
    //             'user_name'     =>  $_POST['user_name'],
    //             'age'           =>  $_POST['age'],
    //             'email'         =>  $_POST['email'],
    //             'password'      => $_POST['password'],
    //             'id'            =>  $id,
    //         ]);
    //     $this->connection->executeStatement($stmt->getSQL(),$stmt->getParameters());
       
    //     // echo "<pre>";
    //     // print_r($_POST);
    //     // print_r($id);
    //     // echo "</pre>";
    //     // exit();
    // }
    public function updateUser($id)  
    {
        try {
            // Lấy dữ liệu từ form
            $user_name = $_POST['user_name'] ?? '';
            $age = $_POST['age'] ?? 0;
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            // Kiểm tra xem dữ liệu có thực sự được gửi lên không
            echo "<pre>";
            echo "📌 Debug dữ liệu nhận từ form:\n";
            print_r($_POST);
            echo "📌 ID cần cập nhật: $id\n";
            echo "</pre>";
    
            // Cập nhật dữ liệu vào database
            $stmt = $this->queryBuilder->update("users")
                ->set('user_name', ':user_name')
                ->set('age', ':age')
                ->set('email', ':email')
                ->set('password', ':password')
                ->where("id = :id");
    
            // ✅ Đặt từng tham số riêng lẻ
            $stmt->setParameter('user_name', $user_name);
            $stmt->setParameter('age', (int)$age); // Ép kiểu age thành số nguyên
            $stmt->setParameter('email', $email);
            $stmt->setParameter('password', password_hash($password, PASSWORD_DEFAULT)); // Mã hóa mật khẩu
            $stmt->setParameter('id', (int)$id); // Ép kiểu id thành số nguyên
    
            // In ra truy vấn để kiểm tra
            echo "🔍 SQL Query: " . $stmt->getSQL();
            echo "<br>🔍 Parameters: ";
            print_r($stmt->getParameters());
    
            // Thực thi truy vấn
            $result = $this->connection->executeStatement($stmt->getSQL(), $stmt->getParameters());
    
            if ($result) {
                echo "✅ Cập nhật thành công!";
            } else {
                echo "❌ Cập nhật thất bại!";
            }
    
            exit(); // Chặn chuyển hướng để kiểm tra kết quả
    
        } catch (\Exception $e) {
            die("❌ Lỗi SQL: " . $e->getMessage());
        }
    }
    
    
}