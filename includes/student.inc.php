<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';

use Views\StudentView;
use Views\StudentInformationView;

// Functions
function index($query){
    $obj = new StudentView();
    $obj->initIndex($query);
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
if (isset($_GET['query'])) {
    $query = $_GET['query']; 
    index($query);
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