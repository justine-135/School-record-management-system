<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/teachers.class.php';

class TeachersController extends \Models\Teachers{
    // Login validation
    public function initLogin($username, $password){
        if ($this->loginEmptyInputs($username, $password) !== false) {
            header("Location: ../login.php?login&error&empty");
            die();
        }
        elseif ($this->initValidateUser($username, $password) !== false) {
            header("Location: ../login.php?login&error&user");
            die();
        }
        else{
            $result = $this->login($username, $password);

            if (count($result) > 0) {
                session_start();

                $_SESSION["last_login_timestamp"] = time();
                $_SESSION['first_name'] = $result[0]['first_name'];
                $_SESSION['middle_name'] = $result[0]['middle_name'];
                $_SESSION['surname'] = $result[0]['surname'];
                $_SESSION['ext_name'] = $result[0]['ext_name'];
                $_SESSION['username'] = $result[0]['username'];
                $_SESSION['account_id'] = $result[0]['account_id'];
                $_SESSION['email'] = $result[0]['email'];
                $_SESSION['is_superadmin'] = $result[0]['superadmin'];
                $_SESSION['is_admin'] = $result[0]['admin'];
                $_SESSION['is_guidance'] = $result[0]['guidance'];
                $_SESSION['is_teacher'] = $result[0]['teacher'];
                $_SESSION['is_author'] = $result[0]['author'];

                // echo '<pre>' . var_dump($result) . "</pre>";
                header("Location: ../index.php");
                // var_dump($result[0]['first_name']);
                die();
            }
            
            else{
                header("Location: ../login.php?login&error&user");
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

    public function initEditPermission($id, $permission){
        $this->editPermission($id, $permission);
        header("Location: ../account_informations.php?id={$id}&permission&submitted");
        die();
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
    $permission, $grade_level, $section){
        if ($this->emptyInputs($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file) !== false) {
            $this->rejectData("error","empty",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission 
        );
            die();
        }
        elseif ($this->validateContact($contact) !== false) {
            $this->rejectData("error","contacterr",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission);
            die();
        }
        elseif ($this->validateSpecialChars($religion, $house_street, $subdivision, $barangay, $city, $province, $region, $surname, $first_name, $middle_name) !== false) {
            $this->rejectData("error","special",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact,
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission);
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
            $permission);
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
            $permission);
            die();
        }
        else{
            $this->create($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
            $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
            $permission, $grade_level, $section);
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
    $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file, $permission){
        header("Location: ../register.php?register&{$catch}&{$type}&surname={$surname}&fname={$first_name}&mname={$middle_name}&extname={$ext_name}&bdate={$birth_date}&gender={$gender}&contact={$contact}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&email={$email}&file={$file}&permission={$permission}");
        die();
    }
}