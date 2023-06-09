<?php

require '../classes/Controllers/grades.class.php';
require '../classes/Views/grades.class.php';

use Controllers\GradesController;
use Views\GradesView;

session_start();

function initAddGrades($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no){
    $obj = new GradesController();
    $obj->initCreate($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no);
}

function initUpdateGrades($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no){
    $obj = new GradesController();
    $obj->initUpdate($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no);
}

function initLoadGrades($lrn){
    $obj = new GradesView();
    $obj->loadGrades($lrn);
}

if (isset($_POST["submit-grade"])) {
    $rows = $_POST['rows'];
    $status = $_POST['status'];
    $page_no = $_POST['page-no'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $lrn = isset($_POST['lrn']) ? $_POST['lrn'] : '';
    $subjects = isset($_POST['subjects']) ? $_POST['subjects'] : array("");
    $first_quarter = isset($_POST['first-quarter']) ? $_POST['first-quarter'] : array();
    $second_quarter = isset($_POST['second-quarter']) ? $_POST['second-quarter'] : array();
    $third_quarter = isset($_POST['third-quarter']) ? $_POST['third-quarter'] : array();
    $fourth_quarter = isset($_POST['fourth-quarter']) ? $_POST['fourth-quarter'] : array();
    $grade_level = isset($_POST['grade-level']) ? $_POST['grade-level'] : '';
    $section = $_POST['section'];
    $remark = $_POST['total-remarks'];

    initAddGrades($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no);
}

if (isset($_POST['update-grade'])) {
    $rows = $_POST['rows'];
    $status = $_POST['status'];
    $page_no = $_POST['page-no'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $lrn = isset($_POST['lrn']) ? $_POST['lrn'] : '';
    $subjects = isset($_POST['subjects']) ? $_POST['subjects'] : array("");
    $first_quarter = isset($_POST['first-quarter']) ? $_POST['first-quarter'] : array();
    $second_quarter = isset($_POST['second-quarter']) ? $_POST['second-quarter'] : array();
    $third_quarter = isset($_POST['third-quarter']) ? $_POST['third-quarter'] : array();
    $fourth_quarter = isset($_POST['fourth-quarter']) ? $_POST['fourth-quarter'] : array();
    $grade_level = isset($_POST['grade-level']) ? $_POST['grade-level'] : '';
    $section = $_POST['section'];
    $remark = $_POST['total-remarks'];

    initUpdateGrades($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark, $rows, $status, $page_no);
}

if (isset($_GET['load_grade'])) {
    $lrn = $_GET['lrn'];
    initLoadGrades($lrn);
}