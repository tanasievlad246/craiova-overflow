<?php
$servername = 'localhost';
$port = '3306';
$username = 'root';
$password = '';
$dbName = 'craiovaOverflow';

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
