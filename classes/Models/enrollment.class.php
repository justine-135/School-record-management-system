<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Enrollment extends \Dbh{
    protected function index($status, $offset, $total_records_per_page, $query, $level, $section){
        try{
            if (empty($level)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?   
                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";
                
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);        
                $results = $stmt->fetchAll();
            }
            else{
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, students_table.ext, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status, enrollment_history_table.promotion_status
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?   
                AND enrollment_history_table.grade_level = ?
                ORDER BY `grade_level` ASC, `surname` ASC
                LIMIT $offset, $total_records_per_page
                ";
                
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level]);        
                $results = $stmt->fetchAll();
            }

            
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    }
    protected function studentCount($status, $level, $section){
        try{
            if (empty($level) || empty($section)) {
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ?
                AND `grade_level` < 7
                AND `transfer` IS NOT NULL
                ";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);
            }
            else{
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ? AND `grade_level` = ? AND `section` = ?
                AND `grade_level` < 7
                AND `transfer` IS NOT NULL
                ";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level, $section]);
            }

            if (!empty($level) && empty($section)) {
                $sql = "SELECT `enrollment_id` FROM `enrollment_history_table` 
                WHERE `status` = ? AND `grade_level` = ?
                AND `grade_level` < 7
                AND `transfer` IS NOT NULL
                ";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level]);
            }

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    protected function create($sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, 
    $father_employment, $father_contact, $mother_surname, $mother_fname, 
    $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
    $guardian_employment, $guardian_contact, $is_beneficiary,
    $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)
    {
        try{
            $image = $file['tmp_name'];
            $base64_image = base64_encode(file_get_contents(addslashes($image)));

            $school = "Sabang Elementary School";
            $status = "Active";
            // Change value
            if ($father_education === "Others") {
                $father_education = $father_education_textbox;
            }

            if ($mother_education === "Others") {
                $mother_education = $mother_education_textbox;
            }

            if ($guardian_education === "Others") {
                $guardian_education = $guardian_education_textbox;
            }
            // Query
            $sql = 
            "INSERT INTO `students_table` (surname, first_name, middle_name, ext, `image`, lrn,
            birth_date, gender, religion, house_street, subdivision, barangay, city, province, region)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO `fathers_table` (student_lrn, father_surname, father_first_name, father_middle_name, father_education, father_employment, father_contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO `mothers_table` (student_lrn, mother_surname, mother_first_name, mother_middle_name, mother_education, mother_employment, mother_contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO `guardians_table` (student_lrn, guardian_surname, guardian_first_name, guardian_middle_name, guardian_education, guardian_employment, guardian_contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);
            INSERT INTO `enrollment_history_table` (student_lrn, from_sy, to_sy, school, grade_level, section, `status`)
            VALUES (?, ?, ?, ?, ?, ?, ?);
            ";
            // Execute
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$sname, $fname, $mname, $extname, $base64_image, $lrn, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region,
            $lrn, $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, $is_beneficiary,
            $lrn, $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact, $is_beneficiary,
            $lrn, $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, $is_beneficiary,
            $lrn, $from_sy, $to_sy, $school, $grade_lvl, $section, $status]);
            $stmt = null;

        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function update($curr_lrn, $enrollment_id, $student_id, $sname, $fname, $mname, $extname, $lrn, $from_sy, $to_sy, $grade_lvl, $section, $file, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, 
    $father_employment, $father_contact, $mother_surname, $mother_fname, 
    $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
    $guardian_employment, $guardian_contact, $is_beneficiary,
    $father_education_textbox, $mother_education_textbox, $guardian_education_textbox){
        try{
            $image = $file['tmp_name'];
            $base64_image = base64_encode(file_get_contents(addslashes($image)));

            $school = "Sabang Elementary School";
            $status = "Active";
            // Change value
            if ($father_education === "Others") {
                $father_education = $father_education_textbox;
            }

            if ($mother_education === "Others") {
                $mother_education = $mother_education_textbox;
            }

            if ($guardian_education === "Others") {
                $guardian_education = $guardian_education_textbox;
            }
            // Query
            $sql = 
            "UPDATE `students_table` SET enrolled_at = enrolled_at, surname = ?, first_name = ?, middle_name = ?, ext = ?, `image` = ?, lrn = ?, birth_date = ?, gender = ?, religion = ?, house_street = ?, subdivision = ?, barangay = ?, city = ?, province = ?, region = ?
            WHERE `student_id` = ?;
            UPDATE `fathers_table` SET student_lrn = ?, father_surname = ?, father_first_name = ?, father_middle_name = ?, father_education = ?, father_employment = ?, father_contact_number = ?, is_beneficiary = ?
            WHERE `student_lrn` = ?;
            UPDATE `mothers_table` SET student_lrn = ?, mother_surname = ?, mother_first_name = ?, mother_middle_name = ?, mother_education = ?, mother_employment = ?, mother_contact_number = ?, is_beneficiary = ?
            WHERE `student_lrn` = ?;
            UPDATE `guardians_table` SET student_lrn = ?, guardian_surname = ?, guardian_first_name = ?, guardian_middle_name = ?, guardian_education = ?, guardian_employment = ?, guardian_contact_number = ?, is_beneficiary = ?
            WHERE `student_lrn` = ?;
            UPDATE `enrollment_history_table` SET student_lrn = ?, from_sy = ?, to_sy = ?, school = ?, grade_level = ?, section = ?, `status` = ?
            WHERE `enrollment_id` = ?;

            ";
            // Execute
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$sname, $fname, $mname, $extname, $base64_image, $lrn, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region, $student_id,
            $lrn, $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, $is_beneficiary, $curr_lrn,
            $lrn, $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact, $is_beneficiary, $curr_lrn,
            $lrn, $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, $is_beneficiary, $curr_lrn,
            $lrn, $from_sy, $to_sy, $school, $grade_lvl, $section, $status, $enrollment_id]);
            $stmt = null;

        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    }

    protected function checkGrades($curr_lrn, $grade_level, $section){
        try{
            $sql = "SELECT * FROM student_grades_table WHERE student_lrn = ? AND grade_level = ? AND section = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$curr_lrn, $grade_level, $section]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function studentExist($lrn){
        try{
            $sql = "SELECT * FROM students_table WHERE lrn = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function batchCreate($id, $lrn, $grade_level, $section){
        try{
            $status = 'Active';
            $from_sy = (int)date('Y');
            $to_sy = (int)date('Y') + 1;

            if ($grade_level > 6) {
                $status = 'Completed';
            }
            $sql = "UPDATE `enrollment_history_table` SET `from_sy` = ?, `to_sy` = ?, `section` = ?, `status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$from_sy, $to_sy, $section, $status, $id, $lrn, $grade_level]);
            $results = $stmt->fetchAll();
            $stmt = null;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function hasActive($lrn){
        try{
            $status = 'Active';
            $sql = "SELECT `status` FROM `enrollment_history_table` WHERE `student_lrn` = ? AND `status` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $status]);

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function levelCurrentlyEnrolled($lrn, $grade_level){
        try{
            $sql = "SELECT `grade_level` FROM `enrollment_history_table` WHERE `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_level]);

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function gradeLevelLower($lrn){
        try{
            $sql = "SELECT `grade_level` FROM `enrollment_history_table` WHERE `student_lrn` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn]);

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function hasTransferred($lrn){
        try{
            $sql = "SELECT `transfer` FROM `enrollment_history_table` WHERE `student_lrn` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn]);

            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function createReturnee($lrn, $from_sy, $to_sy, $grade_lvl, $section){
        try{
            $status = 'Active';
            $school = "Sabang Elementary School";
            $sql = "INSERT INTO `enrollment_history_table` (student_lrn, from_sy, to_sy, school, grade_level, section, `status`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $from_sy, $to_sy, $school, $grade_lvl, $section, $status]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}