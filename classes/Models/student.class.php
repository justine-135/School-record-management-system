<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Student extends \Dbh{
    protected function index($status, $offset, $total_records_per_page, $query, $level, $section){
        try{
            if (!empty($query) && empty($level) && empty($section)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section,  students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status 
                FROM `students_table`, `enrollment_history_table`
                WHERE ? in (students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn)
                AND enrollment_history_table.student_lrn = students_table.lrn
                AND enrollment_history_table.status = ?
                LIMIT $offset, $total_records_per_page
                -- ORDER BY `grade_level` ASC
                ";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query, $status]);
        
                $results = $stmt->fetchAll();
            }
            elseif (!empty($level) && !empty($section) && !empty($query)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status 
                FROM `students_table`, `enrollment_history_table`
                WHERE ? in (students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn)
                AND students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?
                AND enrollment_history_table.grade_level = ?
                AND enrollment_history_table.section = ?
                
                LIMIT $offset, $total_records_per_page";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$query, $status, $level, $section]);        
                $results = $stmt->fetchAll();
            }
            elseif (!empty($level) && !empty($section) && empty($query)) {
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status 
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?
                AND enrollment_history_table.grade_level = ?
                AND enrollment_history_table.section = ?
                
                LIMIT $offset, $total_records_per_page";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status, $level, $section]);        
                $results = $stmt->fetchAll();
            }
            else{
                $sql = "SELECT enrollment_history_table.enrollment_id, students_table.student_id, students_table.lrn, students_table.surname, students_table.first_name, students_table.middle_name, enrollment_history_table.enrolled_at, enrollment_history_table.grade_level, enrollment_history_table.section, students_table.gender, enrollment_history_table.student_lrn, enrollment_history_table.status 
                FROM `students_table`, `enrollment_history_table`
                WHERE students_table.lrn = enrollment_history_table.student_lrn
                AND enrollment_history_table.status = ?
                LIMIT $offset, $total_records_per_page";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$status]);        
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
            $sql = "SELECT * FROM `students_table`, `fathers_table`, `mothers_table`, `guardians_table`, `enrollment_history_table`
            WHERE students_table.lrn = fathers_table.student_lrn
            AND students_table.lrn = mothers_table.student_lrn
            AND students_table.lrn = guardians_table.student_lrn
            AND enrollment_history_table.student_lrn = students_table.lrn
            AND enrollment_history_table.status = 'Active'
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

    protected function gradeSection($grade_level, $lrn){
        try{
            $sql = "SELECT `grade_level`, `section` FROM `enrollment_history_table` WHERE `student_lrn` = ? AND `grade_level` = ?";
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

    protected function studentCount(){
        try{
            $sql = "SELECT `enrollment_id` FROM `enrollment_history_table`";
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