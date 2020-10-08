<?php
include './src/components/header.php';

//$question = Question::getQuestion(55);
//$allUserQuestions = User::getAllUserQuestions(5);
$answers = Answer::getAllAnswersForQuestion(5);

echo var_dump($answers);
