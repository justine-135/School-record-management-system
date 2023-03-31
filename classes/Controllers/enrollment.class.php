<?php

namespace Controllers;

use DateTime;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/enrollment.class.php';

class EnrollmentController extends \Models\Enrollment{
    public function initCreate($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, 
    $father_employment, $father_contact, $mother_surname, $mother_fname, 
    $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
    $guardian_employment, $guardian_contact, $is_beneficiary,
    $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        ){
        $sy = $from_sy . " - " . $to_sy;
        $this->create($sname, $fname, $mname, $extname, $lrn, $sy, $grade_lvl, $bdate, $gender, $religion, 
        $house_street, $subdivision, $barangay, $city, $province, $region,
        $father_surname, $father_fname, $father_mname, $father_education, 
        $father_employment, $father_contact, $mother_surname, $mother_fname, 
        $mother_mname, $mother_education, $mother_employment, $mother_contact,
        $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
        $guardian_employment, $guardian_contact, $is_beneficiary,
        $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
    );
    }

    public function checkValidation(
    $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
    )
    {
        $result = false;
        $err_msg =null;

        if ($this->emptyInputs(
            $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        ) !== false) 
        {
            $err_msg = "missing_inputs";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        );
        }

        elseif ($this->invalidName($sname, $fname, $mname, $extname,
            $father_surname, $father_fname, $father_mname, 
            $mother_surname, $mother_fname, $mother_mname,
            $guardian_surname, $guardian_fname, $guardian_mname) !== false) 
        {
            $err_msg = "invalid_name";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
        }

        elseif ($this->invalidLRN($lrn) !== false) 
        {
            $err_msg = "invalid_lrn";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
        }

        elseif ($this->invalidSchoolYear($from_sy, $to_sy) !== false) 
        {
            $err_msg = "invalid_sy";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
        }

        elseif ($this->invalidBirthDate($bdate) !== false) 
        {
            $err_msg = "invalid_bdate";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
        }

        elseif ($this->invalidEducation($father_education, $mother_education, $guardian_education, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)) 
        {
            $err_msg = "invalid_education";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
        }

        elseif ($this->invalidContactNumber($father_contact, $mother_contact, $guardian_contact) !== false) 
        {
            $err_msg = "invalid_contact";
            $this->rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);
        }

        else{
            return $result;
        }
    }

    protected function emptyInputs($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, 
        $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region,
        $father_surname, $father_fname, $father_mname, $father_contact, $father_education,
        $mother_surname, $mother_fname, $mother_mname, $mother_contact, $mother_education,
        $guardian_surname, $guardian_fname, $guardian_mname, $guardian_contact, $guardian_education,
        $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        )
        {
        $result = false;
        if (empty($sname) || empty($fname) || empty($mname) || empty($extname) || empty($lrn) || 
        empty($from_sy) || empty($to_sy) || empty($grade_lvl) || empty($bdate) || 
        empty($religion) || empty($house_street) || empty($subdivision) || empty($barangay) || 
        empty($city) || empty($province) || empty($region) || 
        empty($father_surname) || empty($father_fname) || empty($father_mname) || empty($father_contact) || empty($father_education) ||
        empty($mother_surname) || empty($mother_fname) || empty($mother_mname) || empty($mother_contact) || empty($mother_education) ||
        empty($guardian_surname) || empty($guardian_fname) || empty($guardian_mname) || empty($guardian_contact) || 
        empty($guardian_education)
        ) 
        {
            $result = true;
        }
        if ($father_education === "Others") {
            if (empty($father_education_textbox)) {
                $result = true;
            }
        }
        if ($mother_education === "Others") {
            if (empty($mother_education_textbox)) {
                $result = true;
            }
        }
        if ($guardian_education === "Others") {
            if (empty($guardian_education_textbox)) {
                $result = true;
            }
        }
        return $result;
    }

    protected function invalidName($sname, $fname, $mname, $extname, 
    $father_surname, $father_fname, $father_mname, 
    $mother_surname, $mother_fname, $mother_mname,
    $guardian_surname, $guardian_fname, $guardian_mname){
        $result = false;
        if (!preg_match("/^[a-zA-Z\s]*$/", $sname) || !preg_match("/^[a-zA-Z\s]*$/", $fname) || 
        !preg_match("/^[a-zA-Z\s]*$/", $mname) || !preg_match("/^[a-zA-Z\s]*$/", $extname) || 
        !preg_match("/^[a-zA-Z\s]*$/", $father_surname) || !preg_match("/^[a-zA-Z\s]*$/", $father_fname) || !preg_match("/^[a-zA-Z\s]*$/", $father_mname) ||
        !preg_match("/^[a-zA-Z\s]*$/", $mother_surname) || !preg_match("/^[a-zA-Z\s]*$/", $mother_fname) || !preg_match("/^[a-zA-Z\s]*$/", $mother_mname) ||
        !preg_match("/^[a-zA-Z\s]*$/", $guardian_surname) || !preg_match("/^[a-zA-Z\s]*$/", $guardian_fname) || !preg_match("/^[a-zA-Z\s]*$/", $guardian_mname)) {
            $result = true;
        }
        return $result;
    }

    protected function invalidLRN($lrn){
        $result = false;
        if (!preg_match("/^[0-9]*$/", $lrn) || strlen($lrn) !== 12) {
            $result = true;
        }
        
        if (count($this->studentExist($lrn)) > 0) {
            $result = true;
        }

        return $result;
    }

    protected function invalidSchoolYear($from_sy, $to_sy){
        $result = false;
        if ($from_sy > $to_sy) {
            $result = true;
        }
        return $result;
    }

    protected function invalidBirthDate($bdate){
        $result = false;
        $ymd = new DateTime($bdate);
        $today = new Datetime(date('y.m.d'));
        $diff = $today->diff($ymd);
        $age = $diff->y;

        if ($age < 5) {
            $result = true;
        }
        return $result;
    }

    protected function invalidEducation($father_education, $guardian_education, $mother_education,
    $father_education_textbox, $mother_education_textbox, $guardian_education_textbox){
        $result = false;
        if ($father_education === "Others") {
            if (!preg_match("/^[a-zA-Z\s]*$/", $father_education_textbox)) {
                $result = true;
            }
        }
        if ($mother_education === "Others") {
            if (!preg_match("/^[a-zA-Z\s]*$/", $mother_education_textbox)) {
                $result = true;
            }
        }
        if ($guardian_education === "Others") {
            if (!preg_match("/^[a-zA-Z\s]*$/", $guardian_education_textbox)) {
                $result = true;
            }
        }
        return $result;
    }

    protected function invalidContactNumber($father_contact, $mother_contact, $guardian_contact){
        $result = false;
        if (!preg_match("/^[0-9]*$/", $father_contact) || strlen($father_contact) !== 11) {
            $result = true;
        }
        if (!preg_match("/^[0-9]*$/", $mother_contact) || strlen($mother_contact) !== 11) {
            $result = true;
        }
        if (!preg_match("/^[0-9]*$/", $guardian_contact) || strlen($guardian_contact) !== 11) {
            $result = true;
        }    
        return $result;
    }

    protected function rejectData($err_msg, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)
    {
        header("Location: ../enrollment.php?err={$err_msg}&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
        die();
    }
}