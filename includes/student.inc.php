<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';

use Views\StudentView;
use Views\StudentInformationView;

// Functions
function index($view){
    $obj = new StudentView();
    $obj->initMasterlist($view);
}

function index2($view){
    $obj = new StudentView();
    $obj->initStudentRecords($view);
}

function singleIndex($id){
    $obj = new StudentInformationView();
    $obj->initSingleIndex($id);    
}

function initAddGradeTable($grade_level, $lrn){
    $obj = new StudentInformationView();
    $obj->addGradesTable($grade_level, $lrn); 
}

function initAddGradeModal($lrn, $grade_level, $section){
    $obj = new StudentView();
    $obj->initGradeModal($lrn, $grade_level, $section);
}


// Requests
if (isset($view)) {
    if ($view == 'masterlist') {
        index($view);
    }
    elseif ($view == 'grading') {
        index($view);
    }
    elseif ($view == 'promotion') {
        index($view);
    }
    elseif ($view == 'batch_enrollment') {
        index($view);
    }
    elseif ($view === 'all_students') {
        index2($view);
    }
}

if (isset($_POST['search'])) {
    $query = $_POST['query'];
    $row = $_POST['row'];
    $page_no = $_POST['page_no'];
    $status = $_POST['status'];
    $level = $_POST['level'];
    $section = $_POST['section'];
    
    header('Location: ' . $_SERVER['HTTP_REFERER'] . "?row={$row}&page_no={$page_no}&status={$status}&level={$level}&section={$section}&query={$query}");
    die();
    // header("Location: ../masterlist.php?row={$row}&page_no={$page_no}&status={$status}&level={$level}&section={$section}&query={$query}");
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