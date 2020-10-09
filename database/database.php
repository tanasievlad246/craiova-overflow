<?php
require "./vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . "/go-ask");
$dotenv->load();

$servername = $_ENV['DB_SERVERNAME'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbName = $_ENV['DB_NAME'];

$connData = "mysql:host=$this->servername;dbname=$this->dbName";
$pdo = new PDO($connData, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$sqlArr = [
    file_get_contents('tables/answers.sql'),
    file_get_contents('tables/questions.sql'),
    file_get_contents('tables/rating_info.sql'),
    file_get_contents('tables/users.sql')
];

//Run each sql file to create tables
foreach ($sqlArr as $sql) {
    $pdo->exec($sql);
}
