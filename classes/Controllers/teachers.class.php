<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/teachers.class.php';

class TeachersController extends \Models\Teachers{
    // Login validation
    public function initLogin($username, $password){
        if ($this->loginEmptyInputs($username, $password) !== false) {
            echo "empty";
        }
        elseif ($this->initValidateUser($username, $password) !== false) {
            echo "user false";
        }
        else{
            $result = $this->login($username, $password);

            if ($result[1]) {
                session_start();

                $dateNow = date("Y-m-d h:i:s");
                $_SESSION["last_login_datetime"] = $dateNow;
                // setcookie("last_login_cookie", $dateNow, time() + (3600), "/");
                $_SESSION['username'] = $result[0][0]['username'];
                $_SESSION['account_id'] = $result[0][0]['account_id'];
                $_SESSION['email'] = $result[0][0]['email'];
                $_SESSION['is_superadmin'] = $result[0][0]['superadmin'];
                $_SESSION['permission_1'] = $result[0][0]['masterlist_view'];
                $_SESSION['permission_2'] = $result[0][0]['masterlist_promotion_retention'];
                $_SESSION['permission_3'] = $result[0][0]['student_info_view'];
                $_SESSION['permission_4'] = $result[0][0]['student_info_edit'];
                $_SESSION['permission_5'] = $result[0][0]['student_info_add_history'];
                $_SESSION['permission_6'] = $result[0][0]['student_info_add_grades'];
                $_SESSION['permission_7'] = $result[0][0]['enrollment_view'];
                $_SESSION['permission_8'] = $result[0][0]['enrollment_add'];
                $_SESSION['permission_9'] = $result[0][0]['users_view'];
                $_SESSION['permission_10'] = $result[0][0]['users_add'];
                $_SESSION['permission_11'] = $result[0][0]['users_edit'];
                $_SESSION['permission_12'] = $result[0][0]['teacher_info_view'];
                $_SESSION['permission_13'] = $result[0][0]['teacher_info_edit'];
                $_SESSION['permission_14'] = $result[0][0]['operations_view'];
                $_SESSION['permission_15'] = $result[0][0]['operations_add'];
                $_SESSION['permission_16'] = $result[0][0]['operations_edit'];

                header("Location: ../index.php");
                die();
            }
            
            else{
                header("Location: ../login.php?login&err");
                die();
            }
            
        }
    }

    public function initChangePassword($username,$oldpass,$newpass,$retypepass){
        if ($this->changePassEmptyInputs($username, $oldpass, $newpass, $retypepass) !== false) {
            echo "empty";
        }
        elseif ($this->changePassSpecialChars($username, $oldpass, $newpass, $retypepass) !== false) {
            echo 'special';
        }
        elseif ($this->initValidateUserChangePass($username, $oldpass) !== true) {
            echo "user false";
        }
        elseif ($this->validatePassword($oldpass, $newpass, $retypepass) !== false) {
            echo 'password not same';
        }
        else{
            $this->changePassword($username, $newpass);
            header("Location: ../login.php?changepass&submitted");
            die();
        }
    }

    protected function loginEmptyInputs($username, $password){
        $result = false;
        if (empty($username) || empty($password)) {
            $result = true;
        }
        return $result;
    }

    protected function loginSpecialChars($username, $password){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)) {
            $result = true;
        }
        return $result;
    }

    protected function changePassEmptyInputs($username, $oldpass, $newpass, $retypepass){
        $result = false;
        if (empty($username) || empty($oldpass) || empty($newpass) || empty($retypepass)) {
            $result = true;
        }
        return $result;
    }

    protected function changePassSpecialChars($username, $oldpass, $newpass, $retypepass){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9@.]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $oldpass) || !preg_match("/^[a-zA-Z0-9]*$/", $newpass) || !preg_match("/^[a-zA-Z0-9]*$/", $retypepass)) {
            $result = true;
        }
        return $result;
    }

    protected function validatePassword($oldpass, $newpass, $retypepass){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $oldpass) || !preg_match("/^[a-zA-Z0-9]*$/", $newpass)) {
            $result = true;
        }
        if ($newpass !== $retypepass) {
            $result = true;
        }
        return $result;
    }

    protected function initValidateUserChangePass($username, $oldpass){
        $result = $this->validateUserPass($username, $oldpass);
  
        return $result;
    }

    protected function initValidateUser($username, $password){
        $result = false;
        $account = $this->validateUser($username, $password);
        if (count($account) === 0) {
            $result = true;
        }
  
        return $result;
    }
    // Registration validation
    public function initCreate($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
    $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
    $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
    $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
    $permission_12, $permission_13, $permission_14, $permission_15, $permission_16, $grade_level, $section){
        if ($this->emptyInputs($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file) !== false) {
            $this->rejectData("error","empty",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16    
        );
            die();
        }
        elseif ($this->validateContact($contact) !== false) {
            $this->rejectData("error","contacterr",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16);
            die();
        }
        elseif ($this->validateSpecialChars($religion, $house_street, $subdivision, $barangay, $city, $province, $region, $surname, $first_name, $middle_name) !== false) {
            $this->rejectData("error","special",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact,
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16);
            die();
        }
        // elseif ($this->validateTin($tin) !== false) {
        //     echo "Invalid tin";
        // }
        // elseif ($this->validateGsisbp($gsisbp) !== false) {
        //     echo "Invalid gsisbp";
        // }

        elseif ($this->validateImage($file) !== false) {
            $this->rejectData("error","filetype",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16);
            die();
        }
        // elseif ($this->validatePassword($password, $confirm_password) !== false) {
        //     $this->rejectData("error","passworderr",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file);
        //     die();
        // }
        // elseif ($this->checkCharacterLength($username, $password) !== false) {
        //     $this->rejectData("error","length",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file);
        //     die();
        // }
        elseif ($this->initTeacherExist($email) !== false) {
            $this->rejectData("error","exist",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16);
            die();
        }
        else{
            $this->create($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
            $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
            $permission_12, $permission_13, $permission_14, $permission_15, $permission_16, $grade_level, $section);
            header("Location: ../register.php?register&submitted");
            die();
        }
    }

    protected function emptyInputs($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file){
        $result = false;
        if (empty($surname) || empty($first_name) || empty($middle_name) || empty($ext_name) || empty($birth_date) || empty($gender) || empty($religion) || 
        empty($house_street) || empty($subdivision) || empty($barangay) || empty($city) || empty($province) || empty($region) || 
        empty($email) || empty($file)){
            $result = true;
        }
        return $result;
    }

    protected function validateContact($contact){
        $result = false;
        if (!preg_match("/^[0-9]*$/", $contact)) {
            $result = true;
        }
        if (strlen($contact) !== 11) {
            $result = true;
        }
        return $result;
    }

    protected function validateSpecialChars($religion, $house_street, $subdivision, $barangay, $city, $province, $region, $surname, $first_name, $middle_name){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $religion) || !preg_match("/^[a-zA-Z0-9]*$/", $house_street) || !preg_match("/^[a-zA-Z0-9]*$/", $subdivision) || !preg_match("/^[a-zA-Z0-9]*$/", $barangay) || !preg_match("/^[a-zA-Z0-9]*$/", $city) || !preg_match("/^[a-zA-Z0-9]*$/", $province) || !preg_match("/^[a-zA-Z0-9]*$/", $region) || !preg_match("/^[a-zA-Z0-9]*$/", $surname) || !preg_match("/^[a-zA-Z0-9]*$/", $first_name) || !preg_match("/^[a-zA-Z0-9]*$/", $middle_name)) {
            $result = true;
        }
        return $result;
    }

    // protected function validateDigits($digit){
    //     $result = false;
    //     if (!preg_match("/^[0-9]*$/", $digit) || strlen($digit) !== 11) {
    //         $result = true;
    //     }
    //     return $result;
    // }

    // protected function validateTin($tin){
    //     $result = $this->validateDigits($tin);
    //     return $result;
    // }

    // protected function validateGsisbp($gsisbp){
    //     $result = $this->validateDigits($gsisbp);
    //     return $result;
    // }

    protected function validateImage($file){
        $result = false;
        $fileinfo = $file["tmp_name"];
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        
        // Get image file extension
        $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
        
        // Validate file input to check if is not empty
        if (! file_exists($file["tmp_name"])) {
            $result = true;
        }    // Validate file input to check if is with valid extension
        else if (! in_array($file_extension, $allowed_image_extension)) {
            $result = true;

        }    // Validate image file size
        else if (($file["size"] > 2000000)) {
            $result = true;

        }    // Validate image file dimension
        // else if ($width > "300" || $height > "200") {
        //     $response = array(
        //         "type" => "error",
        //         "message" => "Image dimension should be within 300X200"
        //     );
        // } 
        // else {
        //     echo "upload";
        //     // $target = "image/" . basename($file["name"]);
        //     // if (move_uploaded_file($file["tmp_name"], $target)) {
        //     //     $response = array(
        //     //         "type" => "success",
        //     //         "message" => "Image uploaded successfully."
        //     //     );
        //     // } else {
        //     //     $response = array(
        //     //         "type" => "error",
        //     //         "message" => "Problem in uploading image files."
        //     //     );
        //     // }
        // }
        return $result;
    }

    // protected function checkCharacterLength($username, $password){
    //     $result = false;
    //     if (strlen($username) < 8 || strlen($password) < 8) {
    //         $result = true;
    //     }
    //     return $result;
    // }

    protected function initTeacherExist($email){
        $result = false;
        if (count($this->teacherExist($email)) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function rejectData($catch, $type, $surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
    $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
    $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
    $permission_12, $permission_13, $permission_14, $permission_15, $permission_16){
        header("Location: ../register.php?register&{$catch}&{$type}&surname={$surname}&fname={$first_name}&mname={$middle_name}&extname={$ext_name}&bdate={$birth_date}&gender={$gender}&contact={$contact}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&email={$email}&file={$file}&permission_1={$permission_1}&permission_2={$permission_2}&permission_3={$permission_3}&permission_4={$permission_4}&permission_5={$permission_5}&permission_6={$permission_6}&permission_7={$permission_7}&permission_8={$permission_8}&permission_9={$permission_9}&permission_10={$permission_10}&permission_11={$permission_11}&permission_12={$permission_12}&permission_13={$permission_13}&permission_14={$permission_14}&permission_15={$permission_15}&permission_16={$permission_16}");
        die();
    }
}