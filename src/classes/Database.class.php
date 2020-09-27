<?php

declare(strict_types=1);
require './src/includes/env.inc.php';

class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbName;

    public function __construct()
    {
        $this->servername = $_ENV['DB_SERVERNAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbName = $_ENV['DB_NAME'];
    }

    public function connect(): mysqli
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
