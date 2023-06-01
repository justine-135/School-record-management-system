<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/teachers.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/teachers.class.php';

use Controllers\TeachersController;
use Views\TeachersView;
use Views\TeacherInformationView;

function register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
$religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
$permission, $grade_level, $section){
    $obj = new TeachersController();
    $obj->initCreate($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, 
    $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $email, $file,
    $permission, $grade_level, $section);
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
  
    $email = $_POST['email'];    
    $file = $_FILES['file'];    

    $permission = $_POST['role'];

    $grade_level = isset($_POST['grade-level']) ? $_POST['grade-level'] : null;
    $section = isset($_POST['section']) ? $_POST['section'] : null;

    register($surname, $first_name, $middle_name, $ext_name, $birth_date, $gender, $contact, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region, 
    $email, $file, $permission, $grade_level, $section);
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

function initSingleIndex(){
    $obj = new TeacherInformationView();
    $obj->initSingleIndexHome();
}

function initIndexStudentDashboard($grade_level, $section){
    $obj = new TeacherInformationView();
    $obj->initIndexStudentDashboard($grade_level, $section);
}

function initPermission($id, $permission){
    $obj = new TeachersController();
    $obj->initEditPermission($id, $permission);
}

function initUpdateProfile($surname, $first_name, $middle_name, $birth_date, $gender, $contact, $religion, $house_street,
    $subdivision, $barangay, $city, $province, $region, $email, $file){
    $obj = new TeachersController();
    $obj->initEditProfile($surname, $first_name, $middle_name, $birth_date, $gender, $contact, $religion, $house_street,
    $subdivision, $barangay, $city, $province, $region, $email, $file);
}

function initChangePasswordProfile($username,$oldpass,$newpass,$retypepass){
    $obj = new TeachersController();
    $obj->initChangePasswordProfile($username,$oldpass,$newpass,$retypepass);
}

function initResetPassword($id){
    $obj = new TeachersController();
    $obj->initResetPassword($id);
}

function initUpdateStatus($id){
    $obj = new TeachersController();
    $obj->initUpdateStatus($id);
}


// Requests
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
    session_destroy();
    header("Location: ../index.php");
}

if (isset($_POST['change'])) {
    $username = $_POST['username'];
    $oldpass = $_POST['old-password'];
    $newpass = $_POST['new-password'];
    $retypepass = $_POST['retype-password'];
    initChangePassword($username,$oldpass,$newpass,$retypepass);
}

if (isset($view)) {
    if ($view == 'index') {
        initSingleIndex();
    }
}

if (isset($_GET['index'])) {
    $grade_level = $_GET['class'];
    $section = $_GET['section'];
    initIndexStudentDashboard($grade_level, $section);
}
// if (isset($_GET['advisories'])) {
//     $username = $_GET['username'];
//     $email = $_GET['email'];
//     initAdvisories($email, $username);
// }

if (isset($_POST['submit-permission'])) {
    $id = $_POST['id'];
    $permission = $_POST['role'];
    $curr_role = $_POST['curr_role'];

    if ($curr_role == 'superadmin') {
        header("Location: ../account_informations.php?id={$id}&permissionedit&error&superadmin");
        die();
    }

    initPermission($id, $permission);
}

if (isset($_POST['edit-profile'])) {
    $surname = $_POST['sname'];
    $first_name = $_POST['fname'];
    $middle_name = $_POST['mname'];
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
  
    $email = $_POST['email'];    
    $file = $_FILES['file'];    

    initUpdateProfile($surname, $first_name, $middle_name, $birth_date, $gender, $contact, $religion, $house_street,
    $subdivision, $barangay, $city, $province, $region, $email, $file);
}

if (isset($_POST['edit-account'])) {
    $username = $_POST['username'];
    $oldpass = $_POST['old-password'];
    $newpass = $_POST['new-password'];
    $retypepass = $_POST['retype-password'];
    initChangePasswordProfile($username,$oldpass,$newpass,$retypepass);
}

if (isset($_POST['reset'])){
    $id = $_POST['id'];

    initResetPassword($id);
}

if (isset($_POST['status'])){
    $id = $_POST['id'];

    initUpdateStatus($id);
}