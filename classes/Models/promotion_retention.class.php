<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class PromotionRetention extends \Dbh{
    protected function getRemarks($id, $lrn){
        try {
            $sql = "SELECT `promotion_status` FROM `enrollment_history_table` WHERE `enrollment_id` = ? AND `student_lrn` = ?;";
            $stmt = $this->connection()->prepare($sql);

            $stmt->execute([$id, $lrn]);
    
            $results = $stmt->fetchAll();
    
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function promote($id, $lrn, $grade_level){
        try {

            $status = 'Completed';
            $promotion_status = 'Promoted';
            $sql = "UPDATE `enrollment_history_table` SET `status` = ?, `promotion_status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$status, $promotion_status, $id, $lrn, $grade_level]);
            $results = $stmt->fetchAll();
            $stmt = null;

            $sql = "SELECT * FROM `enrollment_history_table` WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id, $lrn, $grade_level]);
            $history = $stmt->fetchAll();
            $stmt = null;

            $promoted_level = $history[0]['grade_level'] == 'Kindergarten' ? 1 : ($history[0]['grade_level'] == 6 ? 6 : intval($history[0]['grade_level']) + 1);
            
            $sql = 
            "INSERT INTO `enrollment_history_table` (`student_lrn`, `from_sy`, `to_sy`, `school`, `grade_level`, `status`)
            VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, 0000, 0000, 'Sabang Elementary School', $promoted_level, 'Unenrolled']);
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function retain($id, $lrn, $grade_level){
        try {            
            $status = 'Retained';
            $promotion_status = 'Retained';
            $sql = "UPDATE `enrollment_history_table` SET `status` = ?, `promotion_status` = ? WHERE `enrollment_id` = ? AND `student_lrn` = ? AND `grade_level` = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$status, $promotion_status, $id, $lrn, $grade_level]);
            $results = $stmt->fetchAll();
            $stmt = null;

            $promoted_level = $grade_level;
            
            $sql = 
            "INSERT INTO `enrollment_history_table` (`student_lrn`, `from_sy`, `to_sy`, `school`, `grade_level`, `status`)
            VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, 0000, 0000, 'Sabang Elementary School', $promoted_level, 'Unenrolled']);
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}