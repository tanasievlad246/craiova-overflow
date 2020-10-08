<?php

declare(strict_types=1);
require 'Database.class.php';

class Answer
{
    private $body;
    private $user_owner;
    private $owner_id;
    private $question_id;

    public function __construct($body, $user_owner, $owner_id, $question_id)
    {
        $this->body = $body;
        $this->user_owner = $user_owner;
        $this->owner_id = $owner_id;
        $this->question_id = $question_id;
    }

    public static function getAllAnswersForQuestion(int $qid): array
    {
        return [];
    }

    public function postAnswerToQuestion(): bool
    {
        return false;
    }

    public static function getRating(int $qid): int
    {
        return 0;
    }

    public static function upAnswer(): bool
    {
        return false;
    }

    public static function downAnswer(): bool
    {
        return false;
    }
}
