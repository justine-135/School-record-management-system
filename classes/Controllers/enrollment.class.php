<?php

namespace Controllers;

use DateTime;

include $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Models/enrollment.class.php';

class EnrollmentController extends \Models\Enrollment{
    public function initCreate(
    $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
    )
    {
        if ($this->emptyInputs(
            $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        ) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&empty&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->invalidName($sname, $fname, $mname,
            $father_surname, $father_fname, $father_mname, 
            $mother_surname, $mother_fname, $mother_mname,
            $guardian_surname, $guardian_fname, $guardian_mname) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&nameerr&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->invalidLRN($lrn) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&lrnerr&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->lrnExist($lrn) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&lrnexist&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->invalidSchoolYear($from_sy, $to_sy) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&sy&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->invalidFile($file) !== false) {
            header("Location: ../enrollment.php?enrollment&error&file&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }
        elseif ($this->invalidBirthDate($bdate) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&bdateerr&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->invalidEducation($father_education, $mother_education, $guardian_education, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)) 
        {
            header("Location: ../enrollment.php?enrollment&error&nameerr&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        elseif ($this->invalidContactNumber($father_contact, $mother_contact, $guardian_contact) !== false) 
        {
            header("Location: ../enrollment.php?enrollment&error&contacterr&surname={$sname}&fname={$fname}&mname={$mname}&extname={$extname}&lrn={$lrn}&from_sy={$from_sy}&to_sy={$to_sy}&grade_lvl={$grade_lvl}&section={$section}&bdate={$bdate}&gender={$gender}&religion={$religion}&house_street={$house_street}&subd={$subdivision}&barangay={$barangay}&city={$city}&province={$province}&region={$region}&father_surname={$father_surname}&father_fname={$father_fname}&father_fname={$father_fname}&father_mname={$father_mname}&father_education={$father_education}&father_contact={$father_contact}&mother_surname={$mother_surname}&mother_fname={$mother_fname}&mother_mname={$mother_mname}&mother_education={$mother_education}&mother_employment={$mother_employment}&mother_contact={$mother_contact}&guardian_surname={$guardian_surname}&guardian_fname={$guardian_fname}&guardian_mname={$guardian_mname}&guardian_education={$guardian_education}&guardian_employment={$guardian_employment}&guardian_contact={$guardian_contact}&father_education_textbox={$father_education_textbox}&mother_education_textbox={$mother_education_textbox}&guardian_education_textbox={$guardian_education_textbox}");
            die();
        }

        else{
            $this->create($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, 
            $father_employment, $father_contact, $mother_surname, $mother_fname, 
            $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
            $guardian_employment, $guardian_contact, $is_beneficiary,
            $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);

            header("Location: ../enrollment.php?enrollment&submitted");
            die();
        }
    }

    public function initUpdate($curr_lrn, $student_id, $sname, $fname, $mname, $extname, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)
    {
        if ($this->emptyInputsUpdate(
            $sname, $fname, $mname, $extname, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
            $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
            $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        ) !== false) 
        {
            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&error&empty");
            die();
        }

        elseif ($this->invalidName($sname, $fname, $mname,
            $father_surname, $father_fname, $father_mname, 
            $mother_surname, $mother_fname, $mother_mname,
            $guardian_surname, $guardian_fname, $guardian_mname) !== false) 
        {
            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&error&nameerr");
            die();
        }


        elseif ($this->invalidFile($file) !== false) {
            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&error&filesize");
            die();
        }
        elseif ($this->invalidBirthDate($bdate) !== false) 
        {
            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&error&bdateerr");
            die();
        }

        elseif ($this->invalidEducation($father_education, $mother_education, $guardian_education, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)) 
        {
            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&error&nameerr");
            die();
        }

        elseif ($this->invalidContactNumber($father_contact, $mother_contact, $guardian_contact) !== false) 
        {
            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&error&contacterr");
            die();
        }

        // elseif ($this->checkGradeBeforeUpdate($curr_lrn, $curr_grade_lvl, $curr_section) !== false) {
        //     header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&error&grade");
        //     die();
        // }

        else{
            $this->update($curr_lrn, $student_id, $sname, $fname, $mname, $extname, $file, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, 
            $father_employment, $father_contact, $mother_surname, $mother_fname, 
            $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
            $guardian_employment, $guardian_contact, $is_beneficiary,
            $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);

            header("Location: ../student_informations.php?id={$student_id}&edit_enrollment&edit&submitted");
            die();
        }
    }

    public function batchEnroll($ids, $lrns, $grade_levels, $section){
        if (count($ids) == 0 || $section == null) {
            header("Location: ../batch_enrollment.php?enrollment&error&empty");
            die();
        }
        else{
            for ($i=0; $i < count($ids); $i++) { 
                $this->batchCreate($ids[$i], $lrns[$i], $grade_levels[$i], $section);
            }
            header("Location: ../batch_enrollment.php?enrollment&submitted");
            die();
        }
    }

    public function initSearchLrn($lrn){
        if ($this->invalidLRN($lrn) !== false) {
            header("Location: ../returnee.php?returnee&error&lrn");
            die();
        }
        elseif ($this->initHasActiveHistory($lrn) !== false) {
            header("Location: ../returnee.php?returnee&error&active");
            die();
        }
        elseif ($this->lrnExist($lrn) !== false) {
            header("Location: ../returnee.php?lrn=" . $lrn);
            die();
        }
        else{
            header("Location: ../returnee.php?returnee&error&exist");
            die();
        }
    }

    public function initHasActiveHistory($lrn){
        $result = false;
        if (count($this->hasActive($lrn)) > 0) {
            $result = true;
        }
        return $result;
    }

    public function initEnrollReturnee($lrn, $from_sy, $to_sy, $grade_level, $section){
        if ($this->invalidSchoolYear($from_sy, $to_sy)) {
            header("Location: ../returnee.php?returnee&err&sy");
            die();
        }
        elseif ($this->invalidLRN($lrn)) {
            header("Location: ../returnee.php?returnee&error&lrn");
            die();
        }
        elseif ($this->invalidGradeLevel($lrn, $grade_level)) {
            header("Location: ../returnee.php?returnee&error&gradelevel");
            die();
        }
        elseif ($this->initLevelCurrentlyEnrolled($lrn, $grade_level)) {
            header("Location: ../returnee.php?returnee&error&enrolled");
            die();
        }
        elseif ($this->initHasTransferred($lrn)) {
            header("Location: ../returnee.php?returnee&error&transferree");
            die();
        }
        else{
            $this->createReturnee($lrn, $from_sy, $to_sy, $grade_level, $section);
            header("Location: ../returnee.php?returnee&submitted");
            die();
        }
    }

    protected function initHasTransferred($lrn){
        $result = false;
        $transfers = $this->hasTransferred($lrn);
        $i=0;
        foreach ($transfers as $transfer) {
            $i++;
            if ($i == count($transfers)) {
                if ($transfer['transfer'] != '1') {
                    $result = true;
                }
            }
        }
        return $result;
        // if ($this->initHasTransferred($lrn)) {
        //     $result = true;
        // }
        // return $result;
    }

    protected function initLevelCurrentlyEnrolled($lrn, $grade_level){
        $result = false;
        if (count($this->levelCurrentlyEnrolled($lrn, $grade_level)) > 0) {
            $result = true;
        }
        return $result;
    }

    protected function invalidGradeLevel($lrn, $grade_level){
        $result = false;
        $grade_levels = $this->gradeLevelLower($lrn, $grade_level);
        foreach ($grade_levels as $data) {
            if ($data['grade_level'] !== 'Kindergarten') {
                if ($data['grade_level'] >= $grade_level) {
                    $result = true;
                }
            }
        }
        return $result;
    }

    protected function emptyInputs($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $bdate,
        $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region,
        $father_surname, $father_fname, $father_mname, $father_contact, $father_education,
        $mother_surname, $mother_fname, $mother_mname, $mother_contact, $mother_education,
        $guardian_surname, $guardian_fname, $guardian_mname, $guardian_contact, $guardian_education,
        $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        )
        {
        $result = false;
        if (empty($sname) || empty($fname) || empty($mname) || empty($extname) || empty($lrn) || 
        empty($from_sy) || empty($to_sy) || empty($grade_lvl) || empty($section) || empty($bdate) || 
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

    protected function emptyInputsUpdate($sname, $fname, $mname, $extname, $bdate, 
        $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region,
        $father_surname, $father_fname, $father_mname, $father_contact, $father_education,
        $mother_surname, $mother_fname, $mother_mname, $mother_contact, $mother_education,
        $guardian_surname, $guardian_fname, $guardian_mname, $guardian_contact, $guardian_education,
        $father_education_textbox, $mother_education_textbox, $guardian_education_textbox
        )
        {
        $result = false;
        if (empty($sname) || empty($fname) || empty($mname) || empty($extname) || empty($bdate) || 
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

    protected function invalidName($sname, $fname, $mname, 
    $father_surname, $father_fname, $father_mname, 
    $mother_surname, $mother_fname, $mother_mname,
    $guardian_surname, $guardian_fname, $guardian_mname){
        $result = false;
        if (!preg_match("/^[a-zA-Z\s]*$/", $sname) || !preg_match("/^[a-zA-Z\s]*$/", $fname) || 
        !preg_match("/^[a-zA-Z\s]*$/", $mname) || 
        !preg_match("/^[a-zA-Z\s]*$/", $father_surname) || !preg_match("/^[a-zA-Z\s]*$/", $father_fname) || !preg_match("/^[a-zA-Z\s]*$/", $father_mname) ||
        !preg_match("/^[a-zA-Z\s]*$/", $mother_surname) || !preg_match("/^[a-zA-Z\s]*$/", $mother_fname) || !preg_match("/^[a-zA-Z\s]*$/", $mother_mname) ||
        !preg_match("/^[a-zA-Z\s]*$/", $guardian_surname) || !preg_match("/^[a-zA-Z\s]*$/", $guardian_fname) || !preg_match("/^[a-zA-Z\s]*$/", $guardian_mname)) {
            $result = true;
        }
        return $result;
    }

    protected function lrnExist($lrn){
        $result = false;

        if (count($this->studentExist($lrn)) > 0) {
            $result = true;
        }

        //  var_dump(count($this->studentExist($lrn)));
        //  var_dump($result);

        //  die();
        return $result;
    }

    protected function lrnExist2($lrn){
        $result = false;

        if (count($this->studentExist($lrn)) > 1) {
            $result = true;
        }

        return $result;
    }

    protected function invalidLRN($lrn){
        $result = false;
        if (!preg_match("/^[0-9]*$/", $lrn) || strlen($lrn) !== 12) {
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

    protected function invalidFile($file){
        $result = false;
        
        if ($file['size'] !== 0) {
            $fileinfo = $file["tmp_name"];
            $width = $fileinfo[0];
            $height = $fileinfo[1];
            $allowed_image_extension = array(
                "image/png",
                "image/jpg",
                "image/jpeg"
            );
            
            // Get image file extension
            $file_extension = $file['type'];

            // Validate file input to check if is not empty
            if (! file_exists($file["tmp_name"])) {
                $result = true;
            }    // Validate file input to check if is with valid extension
            else if (!in_array($file_extension, $allowed_image_extension)) {
                $result = true;
            }    // Validate image file size
            else if (($file["size"] > 2000000)) {
                $result = true;
            }
        }else{
            $result = false;
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

    protected function checkGradeBeforeUpdate($curr_lrn, $grade_lvl, $section){
        $result = false;
        if (count($this->checkGrades($curr_lrn, $grade_lvl, $section)) > 0) {
            $result = true;
        }
        return $result;
    }

}