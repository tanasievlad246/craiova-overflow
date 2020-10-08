<?php

declare(strict_types=1);
include_once('Database.class.php');

class Question
{
    private $title;
    private $body;
    private $owner_user;
    private $user_id;
    //private $uuid; -> need to change all ids to unique ids;

    public function __construct(string $title, string $body, string $owner_user, string $user_id)
    {
        $this->title = $title;
        $this->body = $body;
        $this->owner_user = $owner_user;
        $this->user_id = $user_id;
    }

    public static function getAllQuestions(): array
    {
        $db = new Database();
        $sql = "SELECT question_id, title, date FROM questions ORDER BY date desc";
        $stmt = $db->connect()->prepare($sql);
        $result = $stmt->execute();

        if (!$stmt) {
            return [
                "error" => "SQL Error"
            ];
        }

        return $stmt->fetchAll();
    }

    public function askQuestion(): bool
    {
        $db = new Database();
        $sql = "INSERT INTO questions (title, body, owner_user, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $db->connect()->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $result = $stmt->execute([$this->title, $this->body, $this->owner_user, $this->user_id]);

        if ($result) return true;

        return false;
    }

    public static function getQuestion($qid): array
    {
        $db = new Database();
        $sql = "SELECT * FROM questions WHERE question_id=?";
        $stmt = $db->connect()->prepare($sql);

        if (!$stmt) return ["error" => "SQL error"];

        $stmt->execute([$qid]);

        if ($stmt->rowCount() <= 0) {
            return ["error" => "Question not found"];
        }
        return $stmt->fetch();
    }


    /*
     *TODO implement update on the backend and buttons on the front end, the form must be the same with post question form
     * */
    public static function updateQuestion(int $qid, string $title, string $body): bool
    {
        return false;
    }
}
