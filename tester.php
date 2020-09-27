<?php
include './src/components/header.php';

$db = new Database();

$sql = "SELECT * FROM questions";
$stmt = $db->connect();
$stmt->prepare($sql);
// if (!$stmt) {
//     echo "Error";
// } else {
//     $stmt->execute();
//     $result = $stmt->get_result()->fetch_assoc();
//     echo $result;
// }

echo __DIR__;
