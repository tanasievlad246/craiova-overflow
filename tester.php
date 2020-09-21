<?php
include './src/components/header.php';

$user_id = $_SESSION['user_id'];
echo $user_id . " ";

$user = new User($user_id);

$servername = 'localhost';
$username = 'root';
$password = '';
$dbName = 'craiovaoverflow';

$conn = new mysqli($servername, $username, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM rating_info WHERE user_id=? AND answer_id=? AND rating_action=?";
$stmt = $conn->prepare($sql);
$uid = 1;
$aid = 5;
$action = 'like';

if (!$stmt) {
    echo " not stmt!";
} else {
    $stmt->bind_param('iis', $uid, $aid, $action);
    $stmt->execute();
    $stmt->store_result();

    // $r = $stmt->get_result()->fetch_assoc();
    echo " " . $stmt->num_rows;
}
