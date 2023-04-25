<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';
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

function initAddGradeTable($grade_level, $lrn){
    $obj = new StudentInformationView();
    $obj->addGradesTable($grade_level, $lrn); 
}



// Requests
if (isset($masterlist)) {
    $query = ""; 
    index($query);
}

if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $row = $_POST['row'];
    $page_no = $_POST['page_no'];
    $status = $_POST['status'];
    $level = $_POST['level'];
    $section = $_POST['section'];
    
    if ($view == 'masterlist') {
        header("Location: ../masterlist.php?row={$row}&page_no={$page_no}&status={$status}&level={$level}&section={$section}&query={$query}");
    }
    else{
        header("Location: ../promotion.php?row={$row}&page_no={$page_no}&status={$status}&level={$level}&section={$section}&query={$query}");
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    singleIndex($id);
}

if (isset($_GET['grade_level'])) {
    $grade_level = $_GET['grade_level'];
    $lrn = $_GET['lrn'];
    initAddGradeTable($grade_level, $lrn);
}

