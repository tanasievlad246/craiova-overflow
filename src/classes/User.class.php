<?php

declare(strict_types=1);
include_once('Database.class.php');
class User
{

    private $username;
    private $password;
    private $email;

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

    private function checkIfUserAlreadyExists()
    {
        $db = new Database();
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = $db->connect()->prepare($sql);
        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$this->username]);
            $result = $stmt->fetchAll();
            return count($result);
        }
        return false;
    }

    public function register()
    {
        if ($this->checkIfUserAlreadyExists() == 0) {
            $db = new Database();
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $db->connect()->prepare($sql);

            if (!$stmt) {
                return "SQL+Error+at+prepare";
            } else {
                $hashPwd = password_hash($this->password, PASSWORD_DEFAULT); //password_hash($password, PASSWORD_DEFAULT)
                $stmt->execute([$this->username, $this->email, $hashPwd]);
                return true;
            }
        } else {
            return false;
        }
    }

    public static function logOut(): bool
    {
        session_start();
        session_unset();
        session_destroy();
        return true;
    }

    public static function login(string $email, string $password): bool
    {
        $db = new Database();
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $db->connect()->prepare($sql);

        if (!$stmt) {
            return false;
        } else {
            $stmt->execute([$email]);
            $result = $stmt->fetch();

            if ($result) {
                $passwordCheck = password_verify($password, $result['password']);
                if ($passwordCheck == false) {
                    return false;
                } else if ($passwordCheck == true) {
                    session_start();
                    $_SESSION['user_id'] = $result['user_id'];
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['username'] = $result['username'];
                    $_SESSION['joined'] = $result['joined'];
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }
}
