<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class EnrollmentHistory extends \Dbh{
    protected function create($lrn, $from_sy, $to_sy, $grade_lvl, $status){
        try{
            $school = "Sabang Elementary School";
            $sql = "INSERT INTO `enrollment_history_table` (student_lrn, from_sy, to_sy, school, grade, `status`) 
            VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $from_sy, $to_sy, $school, $grade_lvl, $status]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    protected function enrollmentHistoryExists($lrn, $from_sy, $to_sy, $grade_lvl, $status){
        try{
            $sql = "SELECT * FROM `enrollment_history_table` WHERE student_lrn = ? AND from_sy = ? AND to_sy = ? OR student_lrn = ? AND grade = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $from_sy, $to_sy, $lrn, $grade_lvl]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}