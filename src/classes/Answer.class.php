<?php /** @noinspection PhpUndefinedVariableInspection */

declare(strict_types=1);
include_once('Database.class.php');

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
        $db = new Database();
        $sql = "SELECT answer_id, body, username, user_id, question_id FROM answers WHERE question_id=?";
        $stmt = $db->connect()->prepare($sql);
        if (!$stmt) {
            return ["error" => "SQL error"];
        }
        $stmt->execute([$qid]);
        if ($stmt->rowCount() <= 0) {
            return [];
        }
        return $stmt->fetchAll();
    }

    public function postAnswerToQuestion(): bool
    {
        $db = new Database();
        $sql = "INSERT INTO answers (body, username, user_id, question_id) VALUES (?,?,?,?)";
        $stmt = $db->connect()->prepare($sql);
        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$this->body, $this->user_owner, $this->owner_id, $this->question_id]);
            return true;
        }
    }

    private static function getLikes(int $aid): string
    {
        $db = new Database();
        $sql = "SELECT COUNT(rating_action) FROM rating_info WHERE answer_id=? AND rating_action='like'";
        $stmt = $db->connect()->prepare($sql);
        $stmt->execute([$aid]);
        $result = $stmt->fetch();
        return $result["COUNT(rating_action)"];
    }

    private static function getDislikes(int $aid): string
    {
        $db = new Database();
        $sql = "SELECT COUNT(rating_action) FROM rating_info WHERE answer_id=? AND rating_action='dislike'";
        $stmt = $db->connect()->prepare($sql);
        $stmt->execute([$aid]);
        $result = $stmt->fetch();
        return $result["COUNT(rating_action)"];
    }

    public static function getRating(int $aid): int
    {
        $likes = self::getLikes($aid);
        $dislikes = self::getDislikes($aid);
        $rating = $likes - $dislikes;
        return (int) $rating;
    }

    public static function rateAnswer(int $answer_id, int $user_id, string $action): bool
    {
        $db = new Database();
        switch ($action) {
            case 'like':
                $sql = "INSERT INTO rating_info (user_id, answer_id, rating_action) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rating_action='like'";
                $case = "like";
                break;
            case 'dislike':
                $sql = "INSERT INTO rating_info (user_id, answer_id, rating_action) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rating_action='dislike'";
                $case = "dislike";
                break;
            case 'unlike':
                $sql = "DELETE FROM rating_info WHERE user_id=? AND answer_id=?";
                $case = "unlike";
                break;
            case 'undislike':
                $sql = "DELETE FROM rating_info WHERE user_id=? AND answer_id=?";
                $case = "undislike";
                break;
        }

        $stmt = $db->connect()->prepare($sql);
        if (!$stmt) return false;

        switch ($case) {
            case "dislike":
            case "like":
                $stmt->execute([$user_id, $answer_id, $action]);
                return true;
            case "unlike":
            case "undislike":
                $stmt->execute([$user_id, $answer_id]);
                return true;
        }

        return false;
    }
}
