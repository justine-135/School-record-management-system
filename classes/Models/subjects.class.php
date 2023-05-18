<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Subjects extends \Dbh{
    protected function create($subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4){
        try {
            $date = date("Y-m-d");
            $sql = "INSERT INTO `operations_subjects_table` (`updated_at`, `subject`, `grade_level`, `quarter_1`, `quarter_2`, `quarter_3`, `quarter_4`)
            VALUES (?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$date, $subject, $grade, $quarter1, $quarter2, $quarter3, $quarter4]);
            $stmt = null;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function index($level, $offset, $total_records_per_page){
        try {
            if (!empty($level)) {
                $sql = "SELECT * FROM `operations_subjects_table`
                WHERE `grade_level` = ?
                ORDER BY `grade_level` ASC, `subject` ASC
                LIMIT $offset, $total_records_per_page
                ;";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$level]);
        
                $results = $stmt->fetchAll();
                return $results;
            }
            else{
                $sql = "SELECT * FROM `operations_subjects_table`
                ORDER BY `grade_level` ASC, `subject` ASC
                LIMIT $offset, $total_records_per_page
                ;";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
        
                $results = $stmt->fetchAll();
                return $results;
            }

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function subjectsCount($level){
        try {
            if (!empty($level)) {
                $sql = "SELECT * FROM `operations_subjects_table` WHERE `grade_level` = ?;";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$level]);
        
                $results = $stmt->fetchAll();
                return $results;
            }else{
                $sql = "SELECT * FROM `operations_subjects_table`;";
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute();
        
                $results = $stmt->fetchAll();
                return $results;
            }
            
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function subjectExists($subject, $grade){
        try{
            $sql = "SELECT * FROM `operations_subjects_table` WHERE `subject` = ? AND `grade_level` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$subject, $grade]);
    
            $results = $stmt->fetchAll();
            return $results;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function destroy($id){
        try {
            $sql = "DELETE FROM `operations_subjects_table` WHERE `id` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}