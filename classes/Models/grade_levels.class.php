<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class GradeLevels extends \Dbh{
    protected function create($grade, $section){
        try {
            $date = date("Y-m-d");
            $sql = "INSERT INTO `grade_levels_table` (updated_at, grade, section)
            VALUES (?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$date, $grade, $section]);
            $stmt = null;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function indexSelect(){
        try {
            $sql = "SELECT DISTINCT grade FROM `grade_levels_table` ORDER BY grade ASC;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function index(){
        try {
            $sql = "SELECT * FROM `grade_levels_table`;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}