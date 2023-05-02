<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Grades extends \Dbh{
    protected function index($lrn, $grade_level){
        try {
            $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_level]);
    
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function create($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        try {
            $sql = "INSERT INTO `student_grades_table` 
            (`student_lrn`, `grade_level`, `section`, `subject`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$lrn, $grade_level, $section, $subjects[$i], $first_quarter[$i], $second_quarter[$i], $third_quarter[$i], $fourth_quarter[$i]]);
            }

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function update($lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter){
        try {
            $sql = "UPDATE `student_grades_table` 
            SET `first_quarter` = ?, `second_quarter` = ?, `third_quarter` = ?, `fourth_quarter` = ?
            WHERE `student_lrn` = ? AND `grade_level` = ? AND `section` = ? AND `subject` = ?";

            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$first_quarter[$i], $second_quarter[$i], $third_quarter[$i], $fourth_quarter[$i], $lrn, $grade_level, $section, $subjects[$i]]);
            }

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function gradesExists($lrn, $grade_level, $section, $subjects){
        try{
            // var_dump($subjects);
            // $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ? AND `subjects` = ? `first_quarter` = ? AND `second_quarter` = ? AND `third_quarter` = ? AND `fourth_quarter` = ?";
            $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ? AND `section` = ? AND `subject` = ?";
            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$lrn, $grade_level, $section, $subjects[$i]]);
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

    protected function studentEnrolled($lrn, $grade_level){
        try {
            $sql = "SELECT `student_lrn`, `grade_level` FROM `enrollment_history_table` WHERE `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_level]);
    
            $results = $stmt->fetchAll();
            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function validateUser($email, $grade_level, $section){
        try {
            $sql = "SELECT `teacher`, `grade_level`, `section` FROM `teachers_advisory_table` WHERE `teacher` = ? AND `grade_level` = ? AND `section` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email, $grade_level, $section]);
    
            $results = $stmt->fetchAll();
            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
}