<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class PromotionRetention extends \Dbh{
    protected function indexGrades($lrns, $grade_levels){
        try {

            $sql = "SELECT `grade_level`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter` FROM `student_grades_table` WHERE `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);

            $results = array();
            for ($i=0; $i < count($lrns); $i++) { 
                $stmt->execute([$lrns[$i], $grade_levels[$i]]);
                array_push($results,$stmt->fetchAll());
            }
    
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}