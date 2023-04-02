<?php

namespace Models;

include_once $_SERVER['DOCUMENT_ROOT'].'/sabanges/classes/Database/dbh.class.php';

class Truncate extends \Dbh{
    public function truncate(){
        $sql = "TRUNCATE `students_table`;
        TRUNCATE `fathers_table`;
        TRUNCATE `mothers_table`;
        TRUNCATE `guardians_table`;
        TRUNCATE `enrollment_history_table`;";

        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        $stmt = null;
    }
}