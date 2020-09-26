<?php

declare(strict_types=1);
class Database
{
    private string $servername;
    private string $username;
    private string $password;
    private string $dbName;

    public function __construct(string $servername, string $username, string $password, string $dbName)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
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
