<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Subjects extends \Dbh{
    protected function create($subject, $grade){
        try {
            $date = date("Y-m-d");
            $sql = "INSERT INTO `operations_subjects_table` (updated_at, `subject`, grade_level)
            VALUES (?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$date, $subject, $grade]);
            $stmt = null;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function index(){
        try {
            $sql = "SELECT * FROM `operations_subjects_table`;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}