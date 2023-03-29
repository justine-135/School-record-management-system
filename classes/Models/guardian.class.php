<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Guardian extends \Dbh{
    protected function create($lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary){
        try{
            if ($relation === "Father") {
                $sql = "INSERT INTO `fathers_table` (student_lrn, surname, first_name, middle_name, education, employment, contact_number, is_beneficiary)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary]);
                $stmt = null;
            }
            elseif ($relation === "Mother") {
                $sql = "INSERT INTO `mothers_table` (student_lrn, surname, first_name, middle_name, education, employment, contact_number, is_beneficiary)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary]);
                $stmt = null;
            }
            else{
                $sql = "INSERT INTO `guardians_table` (student_lrn, surname, first_name, middle_name, education, employment, contact_number, is_beneficiary)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    
                $stmt = $this->connection()->prepare($sql);
                $stmt->execute([$lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary]);
                $stmt = null;
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}