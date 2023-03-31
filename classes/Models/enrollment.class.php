<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Enrollment extends \Dbh{
    protected function create($sname, $fname, $mname, $extname, $lrn, $sy, $grade_lvl, $bdate, $gender, $religion, 
    $house_street, $subdivision, $barangay, $city, $province, $region,
    $father_surname, $father_fname, $father_mname, $father_education, 
    $father_employment, $father_contact, $mother_surname, $mother_fname, 
    $mother_mname, $mother_education, $mother_employment, $mother_contact,
    $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, 
    $guardian_employment, $guardian_contact, $is_beneficiary,
    $father_education_textbox, $mother_education_textbox, $guardian_education_textbox)
    {
        try{
            // Student
            $sql = "INSERT INTO students_table (surname, first_name, middle_name, ext, lrn, sy,
            grade_level, birth_date, gender, religion, house_street, subdivision, barangay, city, province, region)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$sname, $fname, $mname, $extname, $lrn, $sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region]);
            $stmt = null;

            // Father
            if ($father_education === "Others") {
                $father_education = $father_education_textbox;
            }
            $sql = "INSERT INTO `fathers_table` (student_lrn, father_surname, father_first_name, father_middle_name, father_education, father_employment, father_contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $father_surname, $father_fname, $father_mname, $father_education, $father_employment, $father_contact, $is_beneficiary]);
            $stmt = null;

            // Mother
            if ($mother_education === "Others") {
                $mother_education = $mother_education_textbox;
            }
            $sql = "INSERT INTO `mothers_table` (student_lrn, surname, mother_first_name, mother_middle_name, mother_education, mother_employment, mother_contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $mother_surname, $mother_fname, $mother_mname, $mother_education, $mother_employment, $mother_contact, $is_beneficiary]);
            $stmt = null;

            // Guardian
            if ($guardian_education === "Others") {
                $guardian_education = $guardian_education_textbox;
            }
            $sql = "INSERT INTO `guardians_table` (student_lrn, surname, guardian_first_name, guardian_middle_name, guardian_education, guardian_employment, guardian_contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $guardian_surname, $guardian_fname, $guardian_mname, $guardian_education, $guardian_employment, $guardian_contact, $is_beneficiary]);
            $stmt = null;
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function studentExist($lrn){
        try{
            $sql = "SELECT * FROM students_table WHERE lrn = '$lrn';";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}