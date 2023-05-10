<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/teachers.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/teachers.class.php';

use Controllers\TeachersController;
use Views\TeachersView;
use Views\TeacherInformationView;

function register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
$religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
$permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
$permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
$permission_12, $permission_13, $permission_14, $permission_15, $permission_16, $grade_level, $section){
    $obj = new TeachersController();
    $obj->initCreate($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
    $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
    $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
    $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
    $permission_12, $permission_13, $permission_14, $permission_15, $permission_16, $grade_level, $section);
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
    // $username = $_POST['username'];    
    $email = $_POST['email'];    
    $file = $_FILES['file'];    
    // $password = $_POST['password'];    
    // $confirm_password = $_POST['confirm_password'];    

    $permission_1 = isset($_POST['masterlist-view']) ? $_POST['masterlist-view'] : 0;
    $permission_2 = isset($_POST['masterlist-promotion-retention']) ? $_POST['masterlist-promotion-retention'] : 0;
    $permission_3 = isset($_POST['student-view']) ? $_POST['student-view'] : 0;
    $permission_4 = isset($_POST['student-edit']) ? $_POST['student-edit'] : 0;
    $permission_5 = isset($_POST['student-history']) ? $_POST['student-history'] : 0;
    $permission_6 = isset($_POST['student-grades']) ? $_POST['student-grades'] : 0;
    $permission_7 = isset($_POST['enrollment-view']) ? $_POST['enrollment-view'] : 0;
    $permission_8 = isset($_POST['enrollment-add']) ? $_POST['enrollment-add'] : 0;
    $permission_9 = isset($_POST['teachers-view']) ? $_POST['teachers-view'] : 0;
    $permission_10 = isset($_POST['teachers-add']) ? $_POST['teachers-add'] : 0;
    $permission_11 = isset($_POST['teachers-edit']) ? $_POST['teachers-edit'] : 0;
    $permission_12 = isset($_POST['teacher-view']) ? $_POST['teacher-view'] : 0;
    $permission_13 = isset($_POST['teacher-edit']) ? $_POST['teacher-edit'] : 0;
    $permission_14 = isset($_POST['operations-view']) ? $_POST['operations-view'] : 0;
    $permission_15 = isset($_POST['operations-add']) ? $_POST['operations-add'] : 0;
    $permission_16 = isset($_POST['operations-edit']) ? $_POST['operations-edit'] : 0;

    $grade_level = isset($_POST['grade-level']) ? $_POST['grade-level'] : null;
    $section = isset($_POST['section']) ? $_POST['section'] : null;

    register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region, 
    $email, $file, $permission_1, $permission_2, $permission_3, $permission_4, $permission_5,
    $permission_6, $permission_7, $permission_8, $permission_9, $permission_10, $permission_11,
    $permission_12, $permission_13, $permission_14, $permission_15, $permission_16, $grade_level, $section);
    // register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file);
}

function initValidate($username, $password){
    $obj = new TeachersController();
    $obj->initLogin($username, $password);
}

function initChangePassword($username,$oldpass,$newpass,$retypepass){
    $obj = new TeachersController();
    $obj->initChangePassword($username,$oldpass,$newpass,$retypepass);
}

function initAdvisories($email, $username){
    $obj = new TeachersView();
    $obj->manageAdvisories($email, $username);
}

if (isset($accounts)) {
    index();
}

if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $row = $_POST['row'];
    $page_no = $_POST['page_no'];
    $status = $_POST['status'];

    header("Location: ../accounts.php?row={$row}&page_no={$page_no}&status={$status}&query={$query}");
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

if (isset($_POST['logout'])) {
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["account_id"]);
    header("Location: ../index.php");
}

if (isset($_POST['change'])) {
    $username = $_POST['username'];
    $oldpass = $_POST['old-password'];
    $newpass = $_POST['new-password'];
    $retypepass = $_POST['retype-password'];
    initChangePassword($username,$oldpass,$newpass,$retypepass);
}

// if (isset($_GET['advisories'])) {
//     $username = $_GET['username'];
//     $email = $_GET['email'];
//     initAdvisories($email, $username);
// }