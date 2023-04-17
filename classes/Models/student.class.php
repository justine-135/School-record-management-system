<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Student extends \Dbh{
    protected function index($query){
        try{
            if (!empty($query)) {
                $sql = "SELECT `student_id`, `lrn`, `surname`, `first_name`, `middle_name`, `enrolled_at`, `grade_level`, `gender` FROM `students_table` WHERE ? in (lrn, surname, first_name, middle_name, grade_level,
                enrolled_at, from_sy, to_sy) ORDER BY `grade_level` ASC";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query]);
        
                $results = $stmt->fetchAll();
            }
            else{
                $sql = "SELECT `student_id`, `lrn`, `surname`, `first_name`, `middle_name`, `enrolled_at`, `grade_level`, `gender` FROM `students_table`";
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
            $sql = "SELECT * FROM students_table WHERE lrn = ?";
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

    protected function singleIndex($id){
        try{
            $sql = "SELECT * FROM `students_table`, `fathers_table`, `mothers_table`, `guardians_table`
            WHERE students_table.lrn = fathers_table.student_lrn
            AND students_table.lrn = mothers_table.student_lrn
            AND students_table.lrn = guardians_table.student_lrn
            AND students_table.student_id = ?;
            ";
   
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function subjectIndex($grade_lvl){
        try{
            $sql = "SELECT * FROM `operations_subjects_table` WHERE `grade_level` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$grade_lvl]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function enrollmentHistory($lrn){
        try{
            $sql = "SELECT * FROM `enrollment_history_table` WHERE `student_lrn` = '$lrn'";
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

    protected function getGradeLevelsOptions($lrn, $grade_lvl){
        try{
            $sql = "SELECT * FROM `enrollment_history_table` WHERE `student_lrn` = ? AND `grade_level` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_lvl]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}