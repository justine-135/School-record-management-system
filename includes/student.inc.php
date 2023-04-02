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