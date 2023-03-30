<?php

require '../classes/Controllers/enrollment.class.php';

use Controllers\EnrollmentController;

if (isset($_POST["enroll"])) {

    // Student information
    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $extname = $_POST['extname'];
    $lrn = $_POST['lrn'];
    $from_sy = $_POST['from-sy'];
    $to_sy = $_POST['to-sy'];
    $grade_lvl = $_POST['grade-lvl'];
    $bdate = $_POST['birth-date'];
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

    isset($_POST['f-others-textbox']) ? $father_education_textbox = $_POST['f-others-textbox'] : "";

    $father_employment = $_POST['f-employment-status'];
    $father_contact = $_POST['f-contact-number'];
    $is_beneficary = $_POST['is-beneficiary'];
    
    // Mother information
    $mother_surname = $_POST['m-surname'];
    $mother_fname = $_POST['m-fname'];
    $mother_mname = $_POST['m-mname'];
    $mother_education = $_POST['m-highest-education'];

    isset($_POST['m-others-textbox']) ? $mother_education_textbox = $_POST['m-others-textbox'] : "";

    $mother_relation = "Mother";
    $mother_employment = $_POST['m-employment-status'];
    $mother_contact = $_POST['m-contact-number'];

    // Guardian information
    $guardian_surname = $_POST['g-surname'];
    $guardian_fname = $_POST['g-fname'];
    $guardian_mname = $_POST['g-mname'];
    $guardian_education = $_POST['g-highest-education'];

    isset($_POST['g-others-textbox']) ? $guardian_education_textbox = $_POST['g-others-textbox'] : "";

    $guardian_relation = "Guardian";
    $guardian_employment = $_POST['g-employment-status'];
    $guardian_contact = $_POST['g-contact-number'];

    // Check inputs
    $enrollment_check_obj = new EnrollmentController();
    $enrollment_validation_result = $enrollment_check_obj->checkValidation(
    $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficary);


    if ($enrollment_validation_result !== false) {
        header("Location: ../enrollment.php?error");
        die();
    }
    else{
        // $enrollment_obj = new EnrollmentController();
        // $create_student_obj->initCreate($sname, $fname, $mname, $extname, 
        // $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
        // $house_street, $subdivision, $barangay, $city, $province, $region,
        // $father_surname, $father_fname, $father_mname, $father_education, 
        // $father_employment, $father_contact, $mother_surname, $mother_fname, 
        // $mother_mname, $mother_education, $mother_employment, $mother_contact,
        // $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
        // $guardian_employment, $guardian_contact, $is_beneficary);
        
        header("Location: ../enrollment.php?enrolled");
    }
}
else{
    header("location: ../index.php");
}