<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Advisory extends \Dbh{
    protected function create($email, $username, $grade_level, $section){
        try{
            if ($grade_level !== null || $section !== null) {
                $sql = "INSERT INTO `teachers_advisory_table` (`email`, `username`, `grade_level`, `section`) 
                VALUES (?, ?, ?, ?)";
                
                $stmt = $this->connection()->prepare($sql);
                for ($i=0; $i < count($grade_level); $i++) { 
                    $stmt->execute([$email, $username, $grade_level[$i], $section[$i]]);
                }

            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    protected function destroy($id){
        try {
            $sql = "DELETE FROM `teachers_advisory_table` WHERE id = ?;";
            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$id]);
    
            $results = $stmt->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}