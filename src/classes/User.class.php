<?php

declare(strict_types=1);

class User
{

    private $user_id;
    private $conn;

    public function __construct($uid)
    {
        $this->user_id = $uid;

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'craiovaoverflow';

        $this->conn = new mysqli($servername, $username, $password, $dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function userLiked($answer_id)
    {
        $action = 'like';
        $sql = "SELECT * FROM rating_info WHERE user_id=? AND answer_id=? AND rating_action=?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return "ERROR IN SQL";
        } else {
            $stmt->bind_param('iis', $this->user_id, $answer_id, $action);
            $stmt->execute();
            $stmt->store_result();
        }

        if ($stmt->num_rows > 0) {
            return $stmt->num_rows;
        } else {
            return "false";
        }
    }

    public function userDisliked($answer_id)
    {
        $action = 'dislike';
        $sql = "SELECT * FROM rating_info WHERE user_id=? AND answer_id=? AND rating_action=?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return "ERROR IN SQL";
        } else {
            $stmt->bind_param('iis', $this->user_id, $answer_id, $action);
            $stmt->execute();
            $stmt->store_result();
        }

        if ($stmt->num_rows > 0) {
            return $stmt->num_rows;
        } else {
            return "false";
        }
    }
}
