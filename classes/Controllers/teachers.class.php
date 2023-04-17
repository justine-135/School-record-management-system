<?php

namespace Controllers;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/teachers.class.php';

class TeachersController extends \Models\Teachers{
    // Login validation
    public function initLogin($username, $password){
        if ($this->loginEmptyInputs($username, $password) !== false) {
            echo "empty";
        }
        elseif ($this->loginSpecialChars($username, $password) !== false) {
            echo "special chars";
        }
        elseif ($this->initValidateUser($username, $password) !== false) {
            echo "user false";
        }
        else{
            $dateNow = date("Y-m-d h:i:s");
            session_start();
            // $_SESSION["last_login_datetime"] = $dateNow;
            // setcookie("last_login_cookie", $dateNow, time() + (3600), "/");
            // setcookie("last_login_tmp_cookie", $dateNow, time() + (86400 * 30), "/");

            // $_SESSION['username'] = $username;
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

    protected function initValidateUser($username, $password){
        $result = false;
        $account = $this->validateUser($username, $password);
        if (boolval($account) === false) {
            $result = true;
        }
        return $result;
    }
    // Registration validation
    public function initCreate($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password){
        if ($this->emptyInputs($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password) !== false) {
            $this->rejectData("error","empty",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        elseif ($this->validateContact($contact) !== false) {
            $this->rejectData("error","contacterr",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        elseif ($this->validateSpecialChars($religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $surname, $first_name, $middle_name) !== false) {
            $this->rejectData("error","special",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        // elseif ($this->validateTin($tin) !== false) {
        //     echo "Invalid tin";
        // }
        // elseif ($this->validateGsisbp($gsisbp) !== false) {
        //     echo "Invalid gsisbp";
        // }

        elseif ($this->validateImage($file) !== false) {
            $this->rejectData("error","filetype",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        elseif ($this->validatePassword($password, $confirm_password) !== false) {
            $this->rejectData("error","passworderr",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        elseif ($this->checkCharacterLength($username, $password) !== false) {
            $this->rejectData("error","length",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        elseif ($this->initTeacherExist($username, $email) !== false) {
            $this->rejectData("error","exist",$surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
            die();
        }
        else{
            $this->create($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password);
            die();
        }
    }

    protected function emptyInputs($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password){
        $result = false;
        if (empty($surname) || empty($first_name) || empty($middle_name) || empty($ext_name) || empty($birth_date) || empty($gender) || empty($religion) || 
        empty($house_street) || empty($subdivision) || empty($barangay) || empty($city) || empty($province) || empty($region) || 
        empty($username) || empty($email) || empty($file) || empty($password) || empty($confirm_password)) {
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

    protected function validateSpecialChars($religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $surname, $first_name, $middle_name){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $religion) || !preg_match("/^[a-zA-Z0-9]*$/", $house_street) || !preg_match("/^[a-zA-Z0-9]*$/", $subdivision) || !preg_match("/^[a-zA-Z0-9]*$/", $barangay) || !preg_match("/^[a-zA-Z0-9]*$/", $city) || !preg_match("/^[a-zA-Z0-9]*$/", $province) || !preg_match("/^[a-zA-Z0-9]*$/", $region) || !preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $surname) || !preg_match("/^[a-zA-Z0-9]*$/", $first_name) || !preg_match("/^[a-zA-Z0-9]*$/", $middle_name)) {
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

    protected function validatePassword($password, $confirm_password){
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
            $result = true;
        }
        if ($password !== $confirm_password) {
            $result = true;
        }
            return $result;
        return $result;
    }

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

    protected function checkCharacterLength($username, $password){
        $result = false;
        if (strlen($username) < 8 || strlen($password) < 8) {
            $result = true;
        }
        return $result;
    }

    protected function initTeacherExist($username, $email){
        $result = false;
        if (count($this->teacherExist($username, $email)) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function rejectData($catch, $type, $surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password){
        header("Location: ../register.php?register&{$catch}&{$type}&surname={$surname}&fname={$first_name}&mname={$middle_name}&extname={$ext_name}&bdate={$birth_date}&gender={$gender}&contact={$contact}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&username={$username}&email={$email}&file={$file}&password={$password}&confirm_password={$confirm_password}");
        die();
    }
}