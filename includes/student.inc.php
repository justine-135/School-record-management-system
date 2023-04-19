<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';

use Views\StudentView;
use Views\StudentInformationView;

// Functions
function index($query, $status){
    $obj = new StudentView();
    $obj->initIndex($query, $status);
}

function singleIndex($id){
    $obj = new StudentInformationView();
    $obj->initSingleIndex($id);    
}

function initAddGradeTable($grade_lvl){
    $obj = new StudentInformationView();
    $obj->addGradesTable($grade_lvl); 
}

// Requests
if (isset($_GET['query']) || isset($_GET['status'])) {
    $query = $_GET['query']; 
    $status = $_GET['status']; 
    index($query, $status);
    die();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    singleIndex($id);
}

if (isset($_GET['grade_level'])) {
    $grade_lvl = $_GET['grade_level'];
    initAddGradeTable($grade_lvl);
}