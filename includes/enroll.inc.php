<?php

require '../classes/Controllers/student.class.php';
require '../classes/Controllers/guardian.class.php';

use Controllers\StudentController;
use Controllers\GuardianController;

if (isset($_POST["enroll"])) {

    // Student information
    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lrn = $_POST['lrn'];
    $from_sy = $_POST['from-sy'];
    $to_sy = $_POST['to-sy'];
    $grade_lvl = $_POST['grade-lvl'];
    $bdate = $_POST['birth-date'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $house_street = $_POST['house-number-street'];
    $subdivision = $_POST['subdv-village-zone'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city-municipality'];
    $province = $_POST['province'];
    $region = $_POST['region'];
    
    // Father information
    $father_surname = $_POST['f-surname'];
    $father_fname = $_POST['f-fname'];
    $father_mname = $_POST['f-mname'];
    $father_education = $_POST['f-highest-education'];
    $father_relation = "Father";

    if (isset($_POST['f-others-textbox'])) {
        $father_education = $_POST['f-others-textbox'];
        echo "picked" . "<br>";
    }

    $father_employment = $_POST['f-employment-status'];
    $father_contact = $_POST['f-contact-number'];
    $is_beneficary = $_POST['is-beneficiary'];
    
    // Mother information
    $mother_surname = $_POST['m-surname'];
    $mother_fname = $_POST['m-fname'];
    $mother_mname = $_POST['m-mname'];
    $mother_education = $_POST['m-highest-education'];
    $mother_relation = "Mother";

    if (isset($_POST['m-others-textbox'])) {
        $mother_education = $_POST['m-others-textbox'];
    }

    $mother_employment = $_POST['m-employment-status'];
    $mother_contact = $_POST['m-contact-number'];

    // Guardian information
    $guardian_surname = $_POST['g-surname'];
    $guardian_fname = $_POST['g-fname'];
    $guardian_mname = $_POST['g-mname'];
    $guardian_education = $_POST['g-highest-education'];
    $guardian_relation = "Guardian";

    if (isset($_POST['g-others-textbox'])) {
        $guardian_education = $_POST['g-others-textbox'];
    }

    $guardian_employment = $_POST['g-employment-status'];
    $guardian_contact = $_POST['g-contact-number'];

    // Check inputs
    $student_obj = new StudentController();
    $student_validation_result = $student_obj->checkValidation($sname, $fname, $mname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region);
    $father_obj = new GuardianController();
    $father_validation_result = $father_obj->checkValidation($father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, $is_beneficary);
    $motherObj = new GuardianController();
    $mother_validation_result = $motherObj->checkValidation($mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact, $is_beneficary);
    $guardian_obj = new GuardianController();
    $guardian_validation_result = $guardian_obj->checkValidation($guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, $is_beneficary);

    if ($father_validation_result !== false || $mother_validation_result !== false || $guardian_validation_result !== false || $student_validation_result !== false) {
        header("Location: ../enrollment.php/error");
    }
    else{
        $create_student_obj = new StudentController();
        $create_student_obj->initCreate($sname, $fname, $mname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region);
        
        $create_father_obj = new GuardianController();
        $create_father_obj->initCreate($father_relation, $lrn, $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, $is_beneficary);
        
        $create_mother_obj = new GuardianController();
        $create_mother_obj->initCreate($mother_relation, $lrn, $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact, $is_beneficary);
        
        $create_guardian_obj = new GuardianController();
        $create_guardian_obj->initCreate($guardian_relation, $lrn, $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, $is_beneficary);
        header("Location: ../enrollment.php/enrolled");
    }
}
else{
    header("location: ../index.php");
}

