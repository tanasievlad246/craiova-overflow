<?php
include './src/components/header.php';

$question = Question::getQuestion(5);

echo var_dump($question);
