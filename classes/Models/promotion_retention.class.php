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
}