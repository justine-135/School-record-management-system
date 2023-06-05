<?php

require '../classes/Controllers/advisory.class.php';

use Controllers\AdvisoryController;

function initCreate($email, $username, $grade_level, $section){
    $obj = new AdvisoryController();
    $obj->initCreate($email, $username, $grade_level, $section);
}
function initDestroy($id){
    $obj = new AdvisoryController();
    $obj->initDestroy($id);
}

if (isset($_POST['add'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $grade_level = $_POST['grade-level'];
    $section = $_POST['section'];

    initCreate($email, $username, $grade_level, $section);
}
else{
    header("Location: ../index.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    initDestroy($id);
}
else{
    header("Location: ../index.php");
}
