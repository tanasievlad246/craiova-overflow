<?php session_start();
if (isset($_POST['action'])) {
    include '../classes/Answer.class.php';

    $answerId = $_POST['answer_id'];
    $userId = $_SESSION['user_id'];
    $action = $_POST['action'];

    Answer::rateAnswer($answerId, $userId, $action);
    echo json_encode(["message" => "rate successful!"]);
} else {
    header("Location: ../../index.php");
}
