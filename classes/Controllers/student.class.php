<?php

namespace Controllers;

use DateTime;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentController extends \Models\Student{
    public function initCreate($sname, $fname, $mname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        $sy = $from_sy . " - " . $to_sy;
        $this->create($sname, $fname, $mname, $lrn, $sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region);
    }

    public function checkValidation($sname, $fname, $mname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        $result = false;
        if ($this->emptyInputs($sname, $fname, $mname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region) !== false) {
            header("Location: ../enrollment.php?missing_input");
        }

        elseif ($this->invalidLRN($lrn) !== false) {
            header("Location: ../enrollment.php?invalid_lrn");
        }

        elseif ($this->invalidSchoolYear($from_sy, $to_sy) !== false) {
            header("Location: ../enrollment.php?invalid_sy");
        }

        elseif ($this->invalidBirthDate($bdate) !== false) {
            header("Location: ../enrollment.php?invalid_birthdate");
        }
        
        elseif ($this->invalidAge($age) !== false) {
            header("Location: ../enrollment.php?invalid_age");
        }

        else{
            return $result;
        }
    }

    protected function emptyInputs($sname, $fname, $mname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $age, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        $result = false;
        if (empty($sname) || empty($fname) || empty($mname) || empty($lrn) || empty($from_sy) || empty($to_sy) || empty($grade_lvl) || empty($bdate) || empty($age) || empty($gender) || empty($religion) || empty($house_street) || empty($subdivision) || empty($barangay) || empty($city) || empty($province) || empty($region)) {
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
        $diff_years = $diff->y;

        if ($diff_years < 5) {
            $result = true;
        }
        return $result;
    }

    protected function invalidAge($age){
        $result = false;
        if ($age < 5) {
            $result = true;
        }
        return $result;
    }
}
