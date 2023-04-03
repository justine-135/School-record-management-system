<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/grade_levels.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/subjects.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/grade_levels.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/subjects.class.php';

use Controllers\GradeLevelsController;
use Controllers\SubjectsController;
use Views\GradeLevelsView;
use Views\SubjectsView;

// Functions
function initCreateGrade($grade, $section){
    $obj = new GradeLevelsController();
    $obj->initCreate($grade, $section);
}

function initCreateSubjects($subject, $grade){
    $obj = new SubjectsController();
    $obj->initCreate($subject, $grade);
}

function initIndexSelect(){
    $obj = new GradeLevelsView();
    $obj->initIndexSelect();
}

function initIndexSections(){
    $obj = new SubjectsView();
    $obj->initIndex();
}

function initIndexGradeLevels(){
    $obj = new GradeLevelsView();
    $obj->initIndex();
}

// Post requests
if (isset($_POST['grade-level-submit'])) {
    $grade = $_POST['grade-lvl'];
    $section = $_POST['section'];
    initCreateGrade($grade, $section);
} 

if (isset($_POST['subjects-submit'])) {
    $grade = $_POST['grade-lvl'];
    $subjects = $_POST['subjects'];
    initCreateSubjects($subjects, $grade);
}

if (isset($_GET['grade_level_select'])) {
    initIndexSelect();
}

if (isset($_GET['grade_level_table'])) {
    initIndexGradeLevels();
}

if (isset($_GET['sections_table'])) {
    initIndexSections();
}