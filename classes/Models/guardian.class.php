<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Guardian extends \Dbh{
    protected function create($relation, $lrn, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary){
        try{
            $sql = "INSERT INTO `parent/guardians_table` (student_lrn, relation, surname, first_name, middle_name, education, employment, contact_number, is_beneficiary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $this->connection()->prepare($sql);
            $stmt->execute([$lrn, $relation, $sname, $fname, $mname, $education, $employment, $contact_number, $beneficiary]);
            $stmt = null;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;

    }
}