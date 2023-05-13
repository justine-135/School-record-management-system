<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student_grading.class.php';

use Views\StudentGradingView;

// Functions
function index($view){
    $obj = new StudentGradingView();
    $obj->initIndex($view);
}

if (isset($view)) {
    if ($view == 'grading') {
        index($view);
    }
}
