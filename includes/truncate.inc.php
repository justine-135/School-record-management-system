<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/truncate.class.php';

use Models\Truncate;

$obj = new Truncate();
$obj->truncate();

header("Location: ../index.php");
die();