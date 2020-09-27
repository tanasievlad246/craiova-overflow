<?php
include './src/components/header.php';

$db = new Database();

$sql = "SELECT title FROM questions";
$stmt = $db->connect()->prepare($sql);
$stmt->execute();
$titles = $stmt->fetchAll();

foreach ($titles as $title) {
    print $title['title'] . "<br />";
}
