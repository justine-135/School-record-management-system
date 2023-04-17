<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Subjects extends \Dbh{
    protected function create($subject, $grade, $quarter){
        try {
            $date = date("Y-m-d");
            $sql = "INSERT INTO `operations_subjects_table` (`updated_at`, `subject`, `grade_level`, `quarter`)
            VALUES (?, ?, ?, ?);";

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
}