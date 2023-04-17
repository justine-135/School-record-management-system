<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Teachers extends \Dbh{
    protected function create($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password){
        try{
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Turn file to base64 encoded
            $image = $file['tmp_name'];
            $base64_image = base64_encode(file_get_contents(addslashes($image)));

            $sql = "INSERT INTO `teachers_account_table` (`username`, `email`, `password`, `image`, `status`) 
            VALUES (?, ?, ?, ?, ?);
            INSERT INTO `teachers_table` (`surname`, `first_name`, `middle_name`, `ext_name`, `religion`, `gender`, `contact`, `house_street`, `subdivision`, `barangay`, `city`, `province`, `region`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $email, $hashed_password, $base64_image, 1, $surname, $first_name, $middle_name, $ext_name,
            $religion, $gender, $contact, $house_street, $subdivision, $barangay, $city, $province, $region]);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    
    protected function teacherExist($username, $email){
        try{
            $sql = "SELECT * FROM `teachers_account_table` WHERE `username` = ? OR `email` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $email]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function index(){
        try{
            $sql = "SELECT teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, 
            teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name, teachers_table.gender, teachers_table.contact
            FROM teachers_account_table, teachers_table
            WHERE teachers_account_table.account_id = teachers_table.teacher_id";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function singleIndex($id){
        try{
            $sql = "SELECT teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, teachers_account_table.image,
            teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name, teachers_table.gender, teachers_table.contact
            FROM teachers_table, teachers_account_table
            WHERE teachers_account_table.account_id = teachers_table.teacher_id
            AND teacher_id = ?";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function validateUser($username, $password){
        try{
            $sql = "SELECT `password` FROM `teachers_account_table` WHERE username = ? OR email = ? ";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $username]);
    
            $hashed_password = $stmt->fetchAll();
            $check_password = password_verify($password, $hashed_password[0]["password"]);
            return $check_password;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}