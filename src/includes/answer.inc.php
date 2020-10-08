<?php session_start();
if (isset($_POST['answer-submit'])) {
    include '../classes/Answer.class.php';

    $question_id = $_POST['question_id'];
    $body = $_POST['answer-text'];
    $user = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    $answer = new Answer($body, $user, $user_id, $question_id);
    $answer->postAnswerToQuestion();

    header("Location: ../../question.php?qid={$question_id}&message=Answered+with+success");
    exit();
} else {
    header("Location: ../../register.php?message=Register+before+sending+an+answer");
    exit();
}
