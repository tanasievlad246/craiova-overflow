<?php
include './src/components/header.php';

$questions = Question::getAllQuestions();

foreach ($questions as $arr) {
    echo "<h2>" . $arr['title'] . "</h2>";
}
