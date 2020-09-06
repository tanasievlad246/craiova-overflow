<?php session_start();
if (isset($_POST['answer-submit'])) {
    include './dbh.inc.php';

    $question_id = $_POST['question_id'];
    $body = $_POST['answer-text'];
    $user = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    $qid = gettype($question_id);

    $sql = "INSERT INTO answers (body, username, user_id, question_id) VALUES (?,?,?,?)";
    if (isset($conn)) {
        $stmt = $conn->prepare($sql);
    }

    if (!$stmt) {
        header("Location: http://localhost/craiova-overflow/question.php?qid={$question_id}&error=SQL+Error");
        exit();
    } else {
        $stmt->bind_param("ssii", $body, $user, $user_id, $question_id);
        $stmt->execute();
        header("Location: http://localhost/craiova-overflow/question.php?qid={$question_id}&message=Answered+with+success");
        exit();
    }
    $stmt->close();
} else {
    header("Location: http://localhost/craiova-overflow/register.php?message=Register+before+sending+an+answer");
    exit();
}
