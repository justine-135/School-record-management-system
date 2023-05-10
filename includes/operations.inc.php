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

function initCreateSubjects($subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4){
    $obj = new SubjectsController();
    $obj->checkValidationSubject($subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4);
}

function initIndexSelect($section_params){
    $obj = new GradeLevelsView();
    $obj->initIndexSelect($section_params);
}

function initIndexSelectEnrollmentEdit($section_params){
    $obj = new GradeLevelsView();
    $obj->initIndexSelectEnrollmentEdit($section_params);
}

function initIndexSections(){
    $obj = new SubjectsView();
    $obj->initIndex();
}

function initIndexGradeLevels(){
    $obj = new GradeLevelsView();
    $obj->initIndex();
}

function initIndexSelectNav($section_params){
    $obj = new GradeLevelsView();
    $obj->sectionLink($section_params);
}

// Post requests
if (isset($_POST['grade-level-submit'])) {
    $grade = $_POST['grade-lvl'];
    $section = $_POST['section'];
    initCreateGrade($grade, $section);
} 

if (isset($_POST['subjects-submit'])) {
    $grade = $_POST['grade-lvl'];
    $subject = $_POST['subjects'];
    $quarter1 = isset($_POST['quarter1']) ? $_POST['quarter1'] : 0;
    $quarter2 = isset($_POST['quarter2']) ? $_POST['quarter2'] : 0;
    $quarter3 = isset($_POST['quarter3']) ? $_POST['quarter3'] : 0;
    $quarter4 = isset($_POST['quarter4']) ? $_POST['quarter4'] : 0;

    initCreateSubjects($subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4);
}

if (isset($_GET['section_select'])) {
    $section_params = $_GET['section_select'];
    initIndexSelect($section_params);
}

if (isset($_GET['section_select_enrollment_edit'])) {
    $section_params = $_GET['section_select_enrollment_edit'];
    echo $section_params;
    initIndexSelectEnrollmentEdit($section_params);
}

if (isset($_GET['grade_level_table'])) {
    initIndexGradeLevels();
}

if (isset($_GET['sections_table'])) {
    initIndexSections();
}

if (isset($sections) || isset($_GET['level'])) {
    $section_params = isset($_GET['level']) ? $_GET['level'] : '';
    initIndexSelectNav($section_params);
}
