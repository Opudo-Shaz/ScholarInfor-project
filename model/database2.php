<?php

class Database2
{
    private $dbHost = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "Aris0007@";
    private $dbName = "faweall";
    private $userTbl = "users";
    public $db;

    public function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database 
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }
}
