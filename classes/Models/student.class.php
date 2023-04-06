<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Student extends \Dbh{
    protected function index($query){
        try{
            if (!empty($query)) {
                $sql = "SELECT * FROM `students_table` WHERE ? in (lrn, surname, first_name, middle_name, grade_level,
                enrolled_at, from_sy, to_sy, religion, gender, city, province) LIMIT 20";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query]);
        
                $results = $stmt->fetchAll();
            }
            else{
                $sql = "SELECT * FROM `students_table` LIMIT 20;";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
        
                $results = $stmt->fetchAll();
            }
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    }

    protected function create($sname, $fname, $mname, $extname, $lrn, $sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region){
        try{
            $sql = "INSERT INTO students_table (surname, first_name, middle_name, ext, lrn, sy,
            grade_level, birth_date, gender, religion, house_street, subdivision, barangay, city, province, region)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$sname, $fname, $mname, $extname, $lrn, $sy, $grade_lvl, $bdate, $gender, $religion, $house_street, $subdivision, $barangay, $city, $province, $region]);
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

    protected function singleIndex($id){
        try{
            $sql = "SELECT * FROM `students_table`, `fathers_table`, `mothers_table`, `guardians_table`, 
            `enrollment_history_table`
            WHERE students_table.lrn = fathers_table.student_lrn
            AND students_table.lrn = mothers_table.student_lrn
            AND students_table.lrn = guardians_table.student_lrn
            AND students_table.lrn = enrollment_history_table.student_lrn
            AND students_table.id = $id;
            ";
   
            // $sql = "SELECT `surname`, `first_name`, `middle_name`, `ext`, `lrn`, `grade_level`, `from_sy`, `to_sy`, `birth_date`, `gender`, `religion`, `house_street`,
            // `subdivision`, `barangay`, `city`, `provice`, `region`, `student_lrn`, 
            // `father_first_name`, `father_surname`, `father_middle_name`,
            // `mother_first_name`, `mother_surname`, `mother_middle_name`,
            // `guardian_first_name`, `guardian_surname`, `guardian_middle_name`,
            // `subject`, `grade_level`, `grade` 
            // FROM `students_table`, `fathers_table`, `mothers_table`, `guardians_table`, 
            // `enrollment_history_table`, `operations_subjects_table`
            // WHERE students_table.lrn = fathers_table.student_lrn
            // AND students_table.lrn = mothers_table.student_lrn
            // AND students_table.lrn = guardians_table.student_lrn
            // AND students_table.lrn = enrollment_history_table.student_lrn
            // AND enrollment_history_table.grade = operations_subjects_table.grade_level
            // AND students_table.id = $id;
            // ";

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

    protected function subjectIndex($grade){
        try{
            $sql = "SELECT * FROM `operations_subjects_table` WHERE `grade_level` = '$grade'";
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