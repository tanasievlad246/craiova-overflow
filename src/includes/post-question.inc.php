<?php session_start();

if (isset($_POST['submit-question'])) {
    include 'dbh.inc.php';

    $title = $_POST['title'];
    $body = $_POST['text'];
    $user = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO questions (title, body, owner_user, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    

    if (!$stmt) {
        header("Location: http://localhost/craiova-overflow/components/post-question.php?error=SQL+Error");
        exit();
    } else {
        $stmt->bind_param("sssi", $title, $body, $user, $user_id);
        $stmt->execute();
        header("Location: http://localhost/craiova-overflow/index.php?success=Post+seuccessful");
        exit();
    }
    $stmt->close();
} else {
    header("Location: http://localhost/craiova-overflow/register.php");
    exit();
}