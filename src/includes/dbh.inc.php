<?php
$servername = 'localhost';
$port = '3306';
$username = 'root';
$password = '';
$dbName = 'craiovaoverflow';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
