<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Teachers extends \Dbh{
    protected function create($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
    $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
    $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
    $permission_12, $permission_13, $permission_14, $permission_15, $permission_16, 
    $grade_level, $section){
        try{
            $username = strtoupper($surname) . "12345";
            $password = $birth_date;
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Turn file to base64 encoded
            $image = $file['tmp_name'];
            $base64_image = base64_encode(file_get_contents(addslashes($image)));

            $sql = "INSERT INTO `teachers_account_table` (`username`, `email`, `password`, `image`, `status`, `masterlist_view`, `masterlist_promotion_retention`, `student_info_view`, `student_info_edit`, `student_info_add_history`, `student_info_add_grades`, `enrollment_view`, `enrollment_add`, `users_view`, `users_add`, `users_edit`, `teacher_info_view`, `teacher_info_edit`, `operations_view`, `operations_add`, `operations_edit`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO `teachers_table` (`surname`, `first_name`, `middle_name`, `ext_name`, `birth_date`, `religion`, `gender`, `contact`, `house_street`, `subdivision`, `barangay`, `city`, `province`, `region`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $email, $hashed_password, $base64_image, 1, 
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16,
            $surname, $first_name, $middle_name, $ext_name, $birth_date,
            $religion, $gender, $contact, $house_street, $subdivision, $barangay, $city, $province, $region]);

            $stmt = null;

            if ($grade_level !== null || $section !== null) {
                $sql = "INSERT INTO `teachers_advisory_table` (`teacher`, `grade_level`, `section`) 
                VALUES (?, ?, ?)";
                
                $stmt = $this->connection()->prepare($sql);
                for ($i=0; $i < count($grade_level); $i++) { 
                    $stmt->execute([$email, $grade_level[$i], $section[$i]]);
                }
                
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    
    protected function teacherExist($email){
        try{
            $sql = "SELECT * FROM `teachers_account_table` WHERE `email` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function index($offset, $total_records_per_page, $status, $query){
        try{
            $status = $status == 'active' ? 1 : 0;

            if (!empty($query)) {
                $sql = "SELECT teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, 
                teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name, teachers_table.gender, teachers_table.contact
                FROM teachers_account_table, teachers_table
                WHERE ? in (teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, 
                teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name, teachers_table.gender, teachers_table.contact)
                AND teachers_account_table.account_id = teachers_table.teacher_id
                AND teachers_account_table.status = ?
                LIMIT $offset, $total_records_per_page";
    
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query, $status]);
            }
            else{
                $sql = "SELECT teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, 
                teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name, teachers_table.gender, teachers_table.contact
                FROM teachers_account_table, teachers_table
                WHERE teachers_account_table.account_id = teachers_table.teacher_id
                AND teachers_account_table.status = ?
                LIMIT $offset, $total_records_per_page";
    
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);
            }

    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function accountsCount($status){
        try{
            $status = $status == 'active' ? 1 : 0;

            $sql = "SELECT `account_id` FROM `teachers_account_table` WHERE `status` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$status]);
    
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
            teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name, teachers_table.birth_date, teachers_table.gender, teachers_table.contact, teachers_table.religion,
            teachers_table.house_street, teachers_table.subdivision, teachers_table.barangay, teachers_table.city, teachers_table.province, teachers_table.province, teachers_table.region

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
    
            $result = $stmt->fetchAll();

            return $result;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function login($username, $password){
        try{
            $sql = "SELECT `account_id`, `username`, `email`, `password`, `masterlist_view`, `masterlist_promotion_retention`, `student_info_view`, `student_info_edit`, `student_info_add_history`, `student_info_add_grades`, `enrollment_view`, `enrollment_add`, `users_view`, `users_add`, `users_edit`, `teacher_info_view`, `teacher_info_edit`, `operations_view`, `operations_add`, `operations_edit`
             FROM `teachers_account_table` 
             WHERE username = ? OR email = ? ";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $username]);
    
            $hashed_password = $stmt->fetchAll();
            $check_password = password_verify($password, $hashed_password[0]["password"]);

            return $hashed_password;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}