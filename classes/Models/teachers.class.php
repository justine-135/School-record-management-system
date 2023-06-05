<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Teachers extends \Dbh{
    protected function create($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
    $permission, $grade_level, $section){
        try{
            switch ($permission) {
                case 'teacher':
                    $teacher = 1;
                    $admin = 0;
                    $guidance = 0;
                    $author = 0;
                    break;
                case 'admin':
                    $teacher = 0;
                    $admin = 1;
                    $guidance = 0;
                    $author = 0;
                    break;
                case 'guidance':
                    $teacher = 0;
                    $admin = 0;
                    $guidance = 1;
                    $author = 0;
                    break;
                case 'author':
                    $teacher = 0;
                    $admin = 0;
                    $guidance = 0;
                    $author = 1;
                    break;
                
                default:
                    # code...
                    break;
            }
            $username = "SABANGES" . strtoupper($surname);
            $password = strtoupper($surname) . "12345";
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Turn file to base64 encoded
            $image = $file['tmp_name'];

            if (empty($image)) {
                $base64_image = null;
            }
            else{
                $base64_image = base64_encode(file_get_contents(addslashes($image)));
            }

            $sql = "INSERT INTO `teachers_account_table` (`username`, `email`, `password`, `image`, `status`, `superadmin`, `admin`, `teacher`, `author`, `guidance`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO `teachers_table` (`surname`, `first_name`, `middle_name`, `ext_name`, `birth_date`, `religion`, `gender`, `contact`, `house_street`, `subdivision`, `barangay`, `city`, `province`, `region`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $email, $hashed_password, $base64_image, 1, 0, 
            $admin, $teacher, $author, $guidance, $surname, $first_name, $middle_name, $ext_name, $birth_date,
            $religion, $gender, $contact, $house_street, $subdivision, $barangay, $city, $province, $region]);

            $stmt = null;

            if ($grade_level !== null || $section !== null) {
                $sql = "INSERT INTO `teachers_advisory_table` (`email`, `username`, `grade_level`, `section`) 
                VALUES (?, ?, ?, ?)";
                
                $stmt = $this->connection()->prepare($sql);
                for ($i=0; $i < count($grade_level); $i++) { 
                    $stmt->execute([$email, $username, $grade_level[$i], $section[$i]]);
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
            $sql = "SELECT * FROM `teachers_account_table` WHERE `email` = ? OR `username` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email, $email]);
    
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
                $sql = "SELECT teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, teachers_account_table.image, teachers_account_table.superadmin, teachers_account_table.admin, teachers_account_table.teacher, teachers_account_table.guidance, teachers_account_table.author,
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
                $sql = "SELECT teachers_account_table.account_id, teachers_account_table.added_at, teachers_account_table.username, teachers_account_table.email, teachers_account_table.image, teachers_account_table.superadmin, teachers_account_table.admin, teachers_account_table.teacher, teachers_account_table.guidance, teachers_account_table.author,
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
            $sql = "SELECT acc.account_id, acc.added_at, acc.username, acc.email, acc.superadmin, acc.admin, acc.teacher, acc.author, acc.guidance, acc.image, acc.superadmin, acc.admin, acc.teacher, acc.guidance, acc.author,
            teachers.teacher_id, teachers.surname, teachers.first_name, teachers.middle_name, teachers.ext_name, teachers.birth_date, teachers.gender, teachers.contact, teachers.religion,
            teachers.house_street, teachers.subdivision, teachers.barangay, teachers.city, teachers.province, teachers.province, teachers.region

            FROM teachers_table as teachers, teachers_account_table as acc
            WHERE acc.account_id = teachers.teacher_id
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

    protected function validateUserPass($username, $oldpass){
        try{
            $sql = "SELECT `password` FROM `teachers_account_table` WHERE username = ? OR email = ? ";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $username]);
    
            $result = $stmt->fetchAll();

            $hashed_password = $result;

            $check_password = password_verify($oldpass, $hashed_password[0]['password']);

            return $check_password;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function validateUserPassProfile($oldpass){
        try{
            session_start();

            $sql = "SELECT `password` FROM `teachers_account_table` WHERE `account_id` = ? ";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$_SESSION['account_id']]);
    
            $result = $stmt->fetchAll();

            $hashed_password = $result;

            $check_password = password_verify($oldpass, $hashed_password[0]['password']);

            return $check_password;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function login($username, $password){
        try{
            $sql = "SELECT teachers_account_table.password
            FROM `teachers_account_table` 
            WHERE teachers_account_table.username = ? OR teachers_account_table.email = ? ";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $username]);
    
            $hashed_password = $stmt->fetchAll();
            $check_password = password_verify($password, $hashed_password[0]["password"]);

            $stmt = null;

            if ($check_password) {
                $sql = "SELECT teachers_account_table.account_id, teachers_account_table.username, teachers_account_table.email, teachers_account_table.image, teachers_account_table.password, teachers_account_table.superadmin, teachers_account_table.admin, teachers_account_table.teacher, teachers_account_table.author, teachers_account_table.guidance,
                teachers_table.teacher_id, teachers_table.surname, teachers_table.first_name, teachers_table.middle_name, teachers_table.ext_name
                FROM `teachers_account_table`, `teachers_table` 
                WHERE teachers_account_table.username = ? OR teachers_account_table.email = ?
                AND teachers_account_table.account_id = teachers_table.teacher_id";

                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$username, $username]);

                $result = $stmt->fetchAll();
            }
            else{
                $result = [];
            }

            return $result;

        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function getAdvisories($email, $username){
        try {
            $sql = "SELECT * FROM `teachers_advisory_table` WHERE `email` = ? AND `username` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email, $username]);
    
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function changePassword($username ,$newpass){
        try {
            var_dump($username, $newpass);
            die();
            $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
            
            $sql = "UPDATE `teachers_account_table` SET `password` = ? WHERE `email` = ? OR `username` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$hashed_password, $username, $username]);

            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function changePasswordProfile($newpass, $username){
        try {
            $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
            
            $sql = "UPDATE `teachers_account_table` SET `username` = ?, `password` = ? WHERE `account_id` = ?;
            UPDATE `teachers_advisory_table` SET `username` = ? WHERE `username` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $hashed_password, $_SESSION['account_id'], $username, $_SESSION['username']]);

            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function indexDashboard($grade_level, $section){
        try {
            $sql = "SELECT history.enrollment_id, history.student_lrn, history.grade_level, history.section, history.status,
            student.student_id, student.lrn, student.image, student.first_name, student.middle_name, student.surname, student.ext, student.gender, student.birth_date
            FROM enrollment_history_table as history, students_table as student 
            WHERE history.status = ? 
            AND history.grade_level = ? 
            AND history.section = ?
            AND history.student_lrn = student.lrn";
            
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute(['Active', $grade_level, $section]);
    
            $results = $stmt->fetchAll();

            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function editPermission($id, $permission){
        try {     
            $sql = "UPDATE `teachers_account_table` SET `superadmin` = ?, `admin` = ?, `teacher` = ?, `guidance` = ?, `author` = ? WHERE `account_id` = ?;";
            $stmt = $this->connection()->prepare($sql);

            switch ($permission) {
                case 'teacher':
                    $stmt->execute([0, 0, 1, 0, 0, $id]);
                    break;
                
                case 'admin':
                    $stmt->execute([0, 1, 0, 0, 0, $id]);
                    break;
                
                case 'guidance':
                    $stmt->execute([0, 0, 0, 1, 0, $id]);
                    break;
                
                case 'author':
                    $stmt->execute([0, 0, 0, 0, 1, $id]);
                    break;
                
                default:
                    break;
            }


            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function editProfile($surname, $first_name, $middle_name, $birth_date, $gender, $contact, $religion, $house_street,
    $subdivision, $barangay, $city, $province, $region, $email, $file){
        try {           
            $image = $file['tmp_name'];
            $base64_image = base64_encode(file_get_contents(addslashes($image)));

            $sql = "UPDATE `teachers_table` SET `surname` = ?, `first_name` = ?, `middle_name` = ?, `birth_date` = ?, `gender` = ?, `contact` = ?,`religion` = ?,
            `house_street` = ?, `subdivision` = ?, `barangay` = ?, `city` = ?, `province` = ?, `region` = ? WHERE `teacher_id` = ?;
            UPDATE `teachers_account_table` SET `email` = ?, `image` = ? WHERE `account_id` = ?;
            UPDATE `teachers_advisory_table` SET `email` = ? WHERE `email` = ?";
            
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$surname, $first_name, $middle_name, $birth_date, $gender, $contact, $religion, $house_street,
            $subdivision, $barangay, $city, $province, $region, $_SESSION['teacher_id'],
            $email, $base64_image, $_SESSION['account_id'],
            $email, $_SESSION['email']]);
    
            $_SESSION["last_login_timestamp"] = time();
            $_SESSION['first_name'] = $first_name;
            $_SESSION['middle_name'] = $middle_name;
            $_SESSION['surname'] = $surname;
            $_SESSION['email'] = $email;

            $results = $stmt->fetchAll();

            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function resetPassword($id){
        try{
            $sql = "SELECT `surname` FROM `teachers_table` WHERE `teacher_id` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);
    
            $results = $stmt->fetchAll();
            $surname = $results[0]['surname'];

            $password = strtoupper($surname) . "12345";
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = null;
            $stmt = null;

            $sql = "UPDATE `teachers_account_table` SET `password` = ? WHERE `account_id` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$hashed_password, $id]);

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function updateStatus($id){
        try{
            $sql = "SELECT `status` FROM `teachers_account_table` WHERE `account_id` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);
    
            $results = $stmt->fetchAll();
            $status = $results[0]['status'];

            if ($status == 1) {
                $new_status = 0;
            } else {
                $new_status = 1;
            }

            $sql = null;
            $stmt = null;

            $sql = "UPDATE `teachers_account_table` SET `status` = ? WHERE `account_id` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$new_status, $id]);

            $results = $stmt->fetchAll();
            return $new_status;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function validateStatus($username){
        try{
            $sql = "SELECT `status` FROM `teachers_account_table` WHERE `username` = ? OR `email` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$username, $username]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function usernameExistUpdate(){
        try{
            $sql = "SELECT `username` FROM `teachers_account_table` WHERE `account_id` != ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$_SESSION['account_id']]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function emailExistUpdate(){
        try{
            $sql = "SELECT `email` FROM `teachers_account_table` WHERE `account_id` != ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$_SESSION['account_id']]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}