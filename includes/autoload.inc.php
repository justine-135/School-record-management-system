<?php

spl_autoload_register(function ($class)){
    require str_replace('\\', '/', $class) . 'class.php';
}

$student = new classes\Models\Student;