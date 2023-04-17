<?php

require '../classes/Controllers/grades.class.php';
require '../classes/Views/grades.class.php';

use Controllers\GradesController;
use Views\GradesView;

function initAddGrades($id, $lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
    $obj = new GradesController();
    $obj->initCreate($id, $lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter);
}

function initLoadGrades($lrn){
    $obj = new GradesView();
    $obj->loadGrades($lrn);
}

if (isset($_POST["submit-grade"])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $lrn = isset($_POST['lrn']) ? $_POST['lrn'] : '';
    $subjects = isset($_POST['subjects']) ? $_POST['subjects'] : array("");
    $first_quarter = $_POST['first-quarter'];
    $second_quarter = $_POST['second-quarter'];
    $third_quarter = $_POST['third-quarter'];
    $fourth_quarter = $_POST['fourth-quarter'];
    $grade_lvl = isset($_POST['grade-lvl']) ? $_POST['grade-lvl'] : array("");

    // echo var_dump($first_quarter) . "<br>";
    // echo var_dump($second_quarter) . "<br>";
    // echo var_dump($third_quarter) . "<br>";
    // echo var_dump($fourth_quarter) . "<br>";
    initAddGrades($id, $lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter);
}

if (isset($_GET['load_grade'])) {
    $lrn = $_GET['lrn'];
    initLoadGrades($lrn);
}