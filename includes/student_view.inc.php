<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';

use Views\StudentView;
use Views\StudentInformationView;

$id;

isset($_POST['id']) ? $id = $_POST['id'] : "";
isset($_POST['informations']) ? header('Location: ../student_informations.php') : '';

$view === "masterlist" ? $obj = new StudentView() : (($view === "student_information") ? $obj = new StudentInformationView() : "");
$view === "masterlist" ? $obj->initIndex() : (($view === "student_information") ? $obj->initSingleIndex($id) : "");

