<?php session_start();

if (isset($_POST['submit-question'])) {
    include 'dbh.inc.php';
    include '../classes/Question.class.php';

    $question = new Question($_POST['title'], $_POST['text'], $_SESSION['username'], $_SESSION['user_id']);
    $question->askQuestion();

    header("Location: http://localhost/craiova-overflow/index.php");
    exit();
} else {
    header("Location: http://localhost/craiova-overflow/register.php");
    exit();
}
