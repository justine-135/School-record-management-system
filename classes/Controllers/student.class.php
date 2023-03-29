<?php

namespace Controllers;

use DateTime;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/student.class.php';

class StudentController extends \Models\Student{
    public function initCreate($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        $sy = $from_sy . " - " . $to_sy;
        $this->create($sname, $fname, $mname, $extname, $lrn, $sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region);
    }

    public function checkValidation($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        $result = false;

        if ($this->emptyInputs($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region) !== false) {
            header("Location: ../enrollment.php?err=missing_input&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}");
            die();
        }

        elseif ($this->invalidName($sname, $fname, $mname, $extname) !== false) {
            header("Location: ../enrollment.php?err=invalid_name&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}");
            die();
        }

        elseif ($this->invalidLRN($lrn) !== false) {
            header("Location: ../enrollment.php?err=invalid_lrn&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}");
            die();
        }

        elseif ($this->invalidSchoolYear($from_sy, $to_sy) !== false) {
            header("Location: ../enrollment.php?err=invalid_sy&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}");
            die();
        }

        elseif ($this->invalidBirthDate($bdate) !== false) {
            header("Location: ../enrollment.php?err=invalid_bdate&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}");
            die();
        }

        else{
            return $result;
        }
    }

    protected function emptyInputs($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        $result = false;
        if (empty($sname) || empty($fname) || empty($mname) || empty($extname) || empty($lrn) || empty($from_sy) || empty($to_sy) || empty($grade_lvl) || empty($bdate) || empty($gender) || empty($religion) || empty($house_street) || empty($subdivision) || empty($barangay) || empty($city) || empty($province) || empty($region)) {
            $result = true;
        }
        return $result;
    }

    protected function invalidName($sname, $fname, $mname, $extname){
        $result = false;
        if (!preg_match("/^[a-zA-Z]*$/", $sname) || !preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $mname) || !preg_match("/^[a-zA-Z]*$/", $extname)) {
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
}
