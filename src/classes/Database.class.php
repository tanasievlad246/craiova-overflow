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

    public function connect(): PDO
    {
        $connData = "mysql:host=$this->servername;dbname=$this->dbName";
        $pdo = new PDO($connData, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
