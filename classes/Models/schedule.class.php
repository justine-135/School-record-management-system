<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Schedule extends \Dbh{
    protected function create($start, $end){
        try {
            $type = 'grading';
            $sql =  "INSERT INTO `schedule_table` (`type`, `from`, `to`) VALUES (?, ?, ?);";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$type, $start, $end]);

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function index(){
        try {
            $sql = "SELECT * FROM `schedule_table`;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    protected function destroy($id){
        try {
            $sql = "DELETE FROM `schedule_table` WHERE `id` = ?";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}