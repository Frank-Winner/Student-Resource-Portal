<?php

class Database
{
    private $host = "localhost";
    private $user = "student_admin";
    private $dbname = "student_resource_portal";
    private $password = "student";

    private $conn;

    // public function __construct() {}

    public function conn()
    {
        if ($this->conn === null) {

            try {

                $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";

                $this->conn = new PDO($dsn, $this->user, $this->password);

                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // echo "Connection created";
            } catch (PDOException $e) {
                // echo $e->getMessage();

                die("Connection failed");
            }
        }

        return $this->conn;
    }
}
