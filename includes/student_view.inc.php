<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';

use Views\StudentView;
use Views\StudentInformationView;

// isset($_POST['informations']) ? header('Location: ../student_informations.php?id=' . $id) : '';

$view === "masterlist" ? getAllIndex() : "";
$view === "student_information" ? getSingleIndex() : "";

function getAllIndex(){
    $obj = new StudentView();
    $obj->initIndex();
}

function getSingleIndex(){
    isset($_GET['id']) ? $id = $_GET['id'] : "";
    $obj = new StudentInformationView();
    $obj->initSingleIndex($id);
}

