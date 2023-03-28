<?php

class Dbh
{
    private $host = "localhost";
    private $user = "root";
    private $pwd = "sabangesICT2022";
    // private $pwd = "";
    private $dbName = "sabanges_record_system";

    protected function connection()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $conn = new PDO($dsn, $this->user, $this->pwd);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    }
}