<?php
include './src/components/header.php';

$questions = User::getAllUserQuestions($_SESSION['user_id']);

foreach ($questions as $question) {
    print $question['title'] . "<br />";
}
