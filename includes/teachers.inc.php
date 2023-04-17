<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/teachers.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/teachers.class.php';

use Controllers\TeachersController;
use Views\TeachersView;
use Views\TeacherInformationView;

function register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password){
    $obj = new TeachersController();
    $obj->initCreate($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
}

function index(){
    $obj = new TeachersView();
    $obj->initIndex();
}

function singleIndex($id){
    $obj = new TeacherInformationView();
    $obj->initSingleIndex($id);   
}

if (isset($_POST['register'])) {
    // Basic info
    // $tin = $_POST['tin'];
    // $gsisbp = $_POST['gsisbp'];
    $surname = $_POST['sname'];
    $first_name = $_POST['fname'];
    $middle_name = $_POST['mname'];
    $ext_name = $_POST['extname'];
    $birth_date = $_POST['birth-date'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
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
    $file = $_FILES['file'];    
    $password = $_POST['password'];    
    $confirm_password = $_POST['confirm_password'];    

    register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $username, $email, $file, $password, $confirm_password);
}

function initValidate($username, $password){
    $obj = new TeachersController();
    $obj->initLogin($username, $password);
}

if (isset($_GET['index'])) {
    index();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    singleIndex($id);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    initValidate($username, $password);

}