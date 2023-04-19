<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Enrollment extends \Dbh{
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
            from_sy, to_sy, birth_date, gender, religion, house_street, subdivision, barangay, city, province, region)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
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
            $stmt->execute([$sname, $fname, $mname, $extname, $base64_image, $lrn, $from_sy, $to_sy, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region,
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
}