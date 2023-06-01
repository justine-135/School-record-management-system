<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/enrollment_history.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Controllers/enrollment.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/student.class.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Views/enrollment.class.php';

use Views\EnrollmentView;
use Controllers\EnrollmentController;
use Controllers\EnrollmentHistoryController;
use Views\StudentInformationView;

// function enrollment_form_obj($edit_id){
//     $view_form_obj = new StudentInformationView();
//     $view_form_obj->viewStudentForm($edit_id);

//     return $view_form_obj;
// }

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
    $section = $_POST['section'];
    $file = $_FILES['file'];
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
    $father_education_textbox = null;

    isset($_POST['f-others-textbox']) ? $father_education_textbox = $_POST['f-others-textbox'] : "";

    $father_employment = $_POST['f-employment-status'];
    $father_contact = $_POST['f-contact-number'];
    $is_beneficiary = $_POST['is-beneficiary'];
    
    // Mother information
    $mother_surname = $_POST['m-surname'];
    $mother_fname = $_POST['m-fname'];
    $mother_mname = $_POST['m-mname'];
    $mother_education = $_POST['m-highest-education'];
    $mother_education_textbox = null;

    isset($_POST['m-others-textbox']) ? $mother_education_textbox = $_POST['m-others-textbox'] : "";

    $mother_relation = "Mother";
    $mother_employment = $_POST['m-employment-status'];
    $mother_contact = $_POST['m-contact-number'];

    // Guardian information
    $guardian_surname = $_POST['g-surname'];
    $guardian_fname = $_POST['g-fname'];
    $guardian_mname = $_POST['g-mname'];
    $guardian_education = $_POST['g-highest-education'];
    $guardian_education_textbox = null;

    isset($_POST['g-others-textbox']) ? $guardian_education_textbox = $_POST['g-others-textbox'] : "";

    $guardian_relation = "Guardian";
    $guardian_employment = $_POST['g-employment-status'];
    $guardian_contact = $_POST['g-contact-number'];
    
    // Check inputs
    $enrollment_check_obj = new EnrollmentController();
    $enrollment_validation_result = $enrollment_check_obj->initCreate(
    $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
}
elseif (isset($_POST['add-enrollment-history'])) {
    $id = $_POST['id'];
    $lrn = $_POST['lrn'];
    $from_sy = $_POST['from-sy'];
    $to_sy = $_POST['to-sy'];
    $grade_lvl = $_POST['grade-lvl'];
    $section = $_POST['section'];
    $status = 'Completed';

    $enrollment_history_check_obj = new EnrollmentHistoryController();
    $enrollment_history_validation_result = $enrollment_history_check_obj->checkValidationHistory($id, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $status);
}
elseif (isset($_POST['update'])) {
    // Student information
    $curr_lrn = $_POST['curr-lrn'];
    $student_id = $_POST['student_id'];

    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $extname = $_POST['extname'];
    $file = $_FILES['file'];
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

    $father_employment = $_POST['f-employment-status'];
    $father_contact = $_POST['f-contact-number'];
    $is_beneficiary = $_POST['is-beneficiary'];

    // Mother information
    $mother_surname = $_POST['m-surname'];
    $mother_fname = $_POST['m-fname'];
    $mother_mname = $_POST['m-mname'];
    $mother_education = $_POST['m-highest-education'];

    $mother_relation = "Mother";
    $mother_employment = $_POST['m-employment-status'];
    $mother_contact = $_POST['m-contact-number'];

    // Guardian information
    $guardian_surname = $_POST['g-surname'];
    $guardian_fname = $_POST['g-fname'];
    $guardian_mname = $_POST['g-mname'];
    $guardian_education = $_POST['g-highest-education'];

    $guardian_relation = "Guardian";
    $guardian_employment = $_POST['g-employment-status'];
    $guardian_contact = $_POST['g-contact-number'];
    $father_education_textbox = null; 
    $mother_education_textbox = null;
    $guardian_education_textbox = null;

    // Check inputs
    $enrollment_check_obj = new EnrollmentController();
    $enrollment_validation_result = $enrollment_check_obj->initUpdate(
    $curr_lrn, $student_id, $sname, $fname, $mname, $extname, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary,$father_education_textbox, $mother_education_textbox, $guardian_education_textbox);

    // echo $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
    // $house_street, $subdivision, $barangay, $city, $province, $region,
    // $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    // $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    // $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    // $is_beneficiary;
}
elseif (isset($_POST['batch'])) {
    $section = isset($_POST['section']) ? $_POST['section'] : null;
    $chkbox_students = isset($_POST['chkbox-student']) ? $_POST['chkbox-student'] : null;
    $ids = array();
    $lrns = array();
    $grade_levels = array();

    if ($chkbox_students !== null) {
        foreach ($chkbox_students as $key => $obj) {
            $data = explode(",",$obj);
            array_push($ids, $data[0]);
            array_push($lrns, $data[1]);
            array_push($grade_levels, $data[2]);
        }    
    }

    $enrollment_check_obj = new EnrollmentController();
    $enrollment_validation_result = $enrollment_check_obj->batchEnroll($ids, $lrns, $grade_levels, $section);
}
elseif (isset($view)) {
    if ($view == 'batch_enrollment') {
        $obj = new EnrollmentView();
        $obj->initIndex($view);
    }
    if ($view == 'returnee') {
        $obj = new EnrollmentView();
        $obj->initSingleIndex($view);
    }
}
elseif (isset($_POST['search-lrn'])) {
    $lrn = $_POST['lrn'];
    $enrollment_check_obj = new EnrollmentController();
    $enrollment_validation_result = $enrollment_check_obj->initSearchLrn($lrn);
}
elseif (isset($_POST['enroll-returnee'])) {
    $lrn = $_POST['lrn'];
    $from_sy = $_POST['from-sy'];
    $to_sy = $_POST['to-sy'];
    $grade_level = $_POST['grade-lvl'];
    $section = $_POST['section'];

    $enrollment_check_obj = new EnrollmentController();
    $enrollment_validation_result = $enrollment_check_obj->initEnrollReturnee($lrn, $from_sy, $to_sy, $grade_level, $section);
}
else{
    header("location: ../index.php");
}
