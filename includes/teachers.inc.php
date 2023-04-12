<?php

require '../classes/Controllers/teachers.class.php';

use Controllers\TeachersController;

function register($tin, $gsisbp, $surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password){
    $obj = new TeachersController();
    $obj->initCreate($tin, $gsisbp, $surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
}

if (isset($_POST['register'])) {
    // Basic info
    $tin = $_POST['tin'];
    $gsisbp = $_POST['gsisbp'];
    $surname = $_POST['sname'];
    $first_name = $_POST['fname'];
    $middle_name = $_POST['mname'];
    $ext_name = $_POST['extname'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    // Address
    $house_street = $_POST['house-number-street'];
    $subdivision = $_POST['subdv-village-zone'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city-municipality'];
    $province = $_POST['province'];
    $region = $_POST['region'];
    // Account ino
    $username = $_POST['username'];    
    $email = $_POST['email'];    
    $file = $_POST['file'];    
    $password = $_POST['password'];    
    $confirm_password = $_POST['confirm_password'];    

    register($tin, $gsisbp, $surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
}