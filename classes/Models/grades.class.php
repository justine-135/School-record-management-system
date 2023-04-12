<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Grades extends \Dbh{
    protected function index($lrn, $grade_lvl){
        try {
            $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_lvl]);
    
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function create($lrn, $grade_lvl, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        try {
            $sql = "INSERT INTO `student_grades_table` 
            (`student_lrn`, `grade_level`, `subject`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter`)
            VALUES (?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$lrn, $grade_lvl, $subjects[$i], $first_quarter[$i], $second_quarter[$i], $third_quarter[$i], $fourth_quarter[$i]]);
            }

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function gradesExists($lrn, $grade_lvl, $subjects){
        try{
            // var_dump($subjects);
            // $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ? AND `subjects` = ? `first_quarter` = ? AND `second_quarter` = ? AND `third_quarter` = ? AND `fourth_quarter` = ?";
            $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ? AND `subject` = ?";
            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$lrn, $grade_lvl, $subjects[$i]]);
                $results = $stmt->fetchAll();
                if (count($results) > 0) {
                    break;
                }
            }

            return $results;
    
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function studentEnrolled($lrn, $grade_lvl){
        try {
            $sql = "SELECT `student_lrn`, `grade` FROM `enrollment_history_table` WHERE `student_lrn` = ? AND `grade` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_lvl]);
    
            $results = $stmt->fetchAll();
            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}