<?php

declare(strict_types=1);

class User
{

    private $username;
    private $password;
    private $email;
    private $db;

    public function __construct($username, $password, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->db = new Database();
    }

    public static function userLiked(int $answer_id, int $user_id): bool
    {
        $sql = "SELECT * FROM rating_info WHERE user_id=? AND answer_id=? AND rating_action=?";
        $db = new Database();
        $stmt = $db->connect()->prepare($sql);

        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$user_id, $answer_id, 'like']);
            $result = $stmt->fetchAll();
        }

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function userDisliked(int $answer_id, int $user_id): bool
    {

        $sql = "SELECT * FROM rating_info WHERE user_id=? AND answer_id=? AND rating_action=?";
        $db = new Database();
        $stmt = $db->connect()->prepare($sql);

        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$user_id, $answer_id, 'dislike']);
            $result = $stmt->fetchAll();
        }

        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllUserQuestions(int $user_id): array
    {
        $sql = "SELECT * FROM questions WHERE user_id=?";
        $db = new Database();
        $stmt = $db->connect()->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function register(): bool
    {
        $db = new Database();
        $sql = "SELECT username FROM users WHERE username=?";

        $stmt = $db->connect()->prepare($sql);
        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$this->username]);
            $result = $stmt->fetchAll();

            if (count($result) > 0) {
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $db->connect()->prepare($sql);

                if (!$stmt) {
                    return false;
                } else {
                    $hashPwd = password_hash($this->password, PASSWORD_DEFAULT);
                    $stmt->execute([$this->username, $this->email, $hashPwd]);
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    public static function logOut(): bool
    {
        return true;
    }

    public static function login(): bool
    {
        return true;
    }
}
