<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/grade_levels.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/subjects.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/schedule.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/grade_levels.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/subjects.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/schedule.class.php';

use Controllers\GradeLevelsController;
use Controllers\SubjectsController;
use Controllers\ScheduleController;
use Views\GradeLevelsView;
use Views\SubjectsView;
use Views\ScheduleView;

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

function initDeleteGradeSection($id){
    $obj = new GradeLevelsController();
    $obj->initDestroy($id);
}

function initDeleteSubject($id){
    $obj = new SubjectsController();
    $obj->initDestroy($id);
}

function initIndexSchedule(){
    $obj = new ScheduleView();
    $obj->initIndex();
}

function initCreateSchedule($start, $end){
    $obj = new ScheduleController();
    $obj->initCreate($start, $end);
}

function initDeleteSchedule($id){
    $obj = new ScheduleController();
    $obj->initDestroy($id);
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
    initIndexSelectEnrollmentEdit($section_params);
}

if (isset($view)) {
    if ($view == 'operations_subjects') {
        initIndexSections();
    }
    elseif ($view == 'operations_sections') {
        initIndexGradeLevels();
    }
    elseif ($view == 'operations_grading') {
        initIndexSchedule();
    }
}


if (isset($sections) || isset($_GET['level'])) {
    if ($view !== 'operations_subjects' && $view !== 'operations_sections' && $view !== 'operations_grading') {
        $section_params = isset($_GET['level']) ? $_GET['level'] : '';
        initIndexSelectNav($section_params);
    }
}

if (isset($_POST['delete-section'])) {
    $id = $_POST['id'];

    initDeleteGradeSection($id);
}

if (isset($_POST['delete-subject'])) {
    $id = $_POST['id'];

    initDeleteSubject($id);
}


if (isset($_POST['delete-schedule'])) {
    $id = $_POST['id'];

    initDeleteSchedule($id);
}


if (isset($_POST['schedule-submit'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];

    initCreateSchedule($start, $end);
}
