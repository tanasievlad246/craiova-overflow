<?php
session_start();
if (isset($_POST['update']) && isset($_SESSION['user_id']))
{
    include '../classes/Question.class.php';
    Question::updateQuestion($_POST['question_id'], $_POST['title'], $_POST['body']);
    header("Location: ../../question.php?qid={$_POST['question_id']}");
    exit();
} else {
    header("Location: ../../index.php?=You+need+to+be+logged+in+to+edit+questions");
    exit();
}