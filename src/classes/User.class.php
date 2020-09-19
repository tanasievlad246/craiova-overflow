<?php

declare(strict_types=1);

class User
{

    private $user_id;

    public function __construct()
    {
        $this->user_id = $_SESSION['user_id'];
    }

    public function userLiked($post_id): bool
    {

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'craiovaoverflow';

        $conn = new mysqli($servername, $username, $password, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $sql = "SELECT * FROM rating_info WHERE user_id=$this->user_id AND post_id=$post_id AND rating_action='like'";
        $result = $conn->query($sql);

        if ($result->num_rows < 0) {
            return true;
        } else {
            return false;
        }
    }

    public function userDisliked($post_id): bool
    {
        $sql = "SELECT * FROM rating_info WHERE user_id=$this->user_id AND post_id=$post_id AND rating_action='dislike'";
        $stmt = $this->conn->prepare_stmt($sql);
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
