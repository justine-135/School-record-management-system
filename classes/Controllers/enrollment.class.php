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

        elseif ($this->invalidName($sname, $fname, $mname, $extname,
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
            # code...
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

    public function initUpdate($curr_lrn, $curr_grade_lvl, $curr_section, $enrollment_id, $student_id, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, 
    $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, 
    $is_beneficiary, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)
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
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&empty");
            die();
        }

        elseif ($this->invalidName($sname, $fname, $mname,
            $father_surname, $father_fname, $father_mname, 
            $mother_surname, $mother_fname, $mother_mname,
            $guardian_surname, $guardian_fname, $guardian_mname) !== false) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&nameerr");
            die();
        }

        elseif ($this->invalidLRN($lrn) !== false) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&lrnerr");
            die();
        }

        elseif ($this->lrnExist2($lrn) !== false) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&lrnexist");
            die();
        }

        elseif ($this->invalidSchoolYear($from_sy, $to_sy) !== false) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&sy");
            die();
        }

        elseif ($this->invalidFile($file) !== false) {
            # code...
        }
        elseif ($this->invalidBirthDate($bdate) !== false) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&bdateerr");
            die();
        }

        elseif ($this->invalidEducation($father_education, $mother_education, $guardian_education, $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&nameerr");
            die();
        }

        elseif ($this->invalidContactNumber($father_contact, $mother_contact, $guardian_contact) !== false) 
        {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&contacterr");
            die();
        }

        elseif ($this->checkGradeBeforeUpdate($curr_lrn, $curr_grade_lvl, $curr_section) !== false) {
            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&error&grade");
            die();
        }

        else{
            $this->update($curr_lrn, $enrollment_id, $student_id, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
            $house_street, $subdivision, $barangay, $city, $province, $region,
            $father_surname, $father_fname, $father_mname, $father_education, 
            $father_employment, $father_contact, $mother_surname, $mother_fname, 
            $mother_mname, $mother_education, $mother_employment, $mother_contact,
            $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
            $guardian_employment, $guardian_contact, $is_beneficiary,
            $father_education_textbox, $mother_education_textbox, $guardian_education_textbox);

            header("Location: ../student_informations.php?id={$enrollment_id}&edit_enrollment&submitted");
            die();
        }
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

    protected function invalidName($sname, $fname, $mname, 
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
        $fileinfo = $file["tmp_name"];
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        
        // Get image file extension
        $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
        
        // Validate file input to check if is not empty
        if (! file_exists($file["tmp_name"])) {
            $result = true;
        }    // Validate file input to check if is with valid extension
        else if (! in_array($file_extension, $allowed_image_extension)) {
            $result = true;

        }    // Validate image file size
        else if (($file["size"] > 2000000)) {
            $result = true;

        }    // Validate image file dimension
        // else if ($width > "300" || $height > "200") {
        //     $response = array(
        //         "type" => "error",
        //         "message" => "Image dimension should be within 300X200"
        //     );
        // } 
        // else {
        //     echo "upload";
        //     // $target = "image/" . basename($file["name"]);
        //     // if (move_uploaded_file($file["tmp_name"], $target)) {
        //     //     $response = array(
        //     //         "type" => "success",
        //     //         "message" => "Image uploaded successfully."
        //     //     );
        //     // } else {
        //     //     $response = array(
        //     //         "type" => "error",
        //     //         "message" => "Problem in uploading image files."
        //     //     );
        //     // }
        // }
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