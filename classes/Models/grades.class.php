<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Grades extends \Dbh{
    protected function index($lrn, $grade_level){
        try {
            $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ? ORDER BY `subject` ASC;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $grade_level]);
    
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function create($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark){
        try {
            $sql = 
            "INSERT INTO `student_grades_table` 
            (`student_lrn`, `grade_level`, `section`, `subject`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$lrn, $grade_level, $section, $subjects[$i], $first_quarter[$i], $second_quarter[$i], $third_quarter[$i], $fourth_quarter[$i]]);
            }

            $sql = "UPDATE `enrollment_history_table` SET `promotion_status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$remark, $id, $lrn]);

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function update($id, $lrn, $grade_level, $section, $subjects, $first_quarter, $second_quarter, $third_quarter, $fourth_quarter, $remark){
        try {
            var_dump($first_quarter);
            var_dump($second_quarter);
            var_dump($third_quarter);
            var_dump($fourth_quarter);
            $sql = "UPDATE `student_grades_table` 
            SET `first_quarter` = ?, `second_quarter` = ?, `third_quarter` = ?, `fourth_quarter` = ?
            WHERE `student_lrn` = ? AND `grade_level` = ? AND `section` = ? AND `subject` = ?;";

            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$first_quarter[$i], $second_quarter[$i], $third_quarter[$i], $fourth_quarter[$i], $lrn, $grade_level, $section, $subjects[$i]]);
            }

            $sql = "UPDATE `enrollment_history_table` SET `promotion_status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$remark, $id, $lrn]);

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function gradesExists($lrn, $grade_level, $section, $subjects){
        try{
            $sql = "SELECT * FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ? AND `subject` = ?";
            $stmt = $this->connection()->prepare($sql);

            for ($i=0; $i < count($subjects); $i++) { 
                $stmt->execute([$lrn, $grade_level, $subjects[$i]]);
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

    protected function validateUser($email, $username, $grade_level, $section){
        try {
            $sql = "SELECT `email`, `username`, `grade_level`, `section` FROM `teachers_advisory_table` WHERE `email` = ? AND `username` = ? AND `grade_level` = ? AND `section` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$email, $username, $grade_level, $section]);
    
            $results = $stmt->fetchAll();
            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }

    protected function gradingPeriod(){
        try {
            $sql = "SELECT `from`, `to` FROM `schedule_table`;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
}