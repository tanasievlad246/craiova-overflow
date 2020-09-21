<?php session_start();
if (isset($_POST['action'])) {
    include './dbh.inc.php';

    $userId = $_SESSION['user_id'];
    $answerId = $_POST['answer_id'];
    $action = $_POST['action'];

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

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location: http://localhost/craiova-overflow/error.php?error=SQL+Error");
        exit();
    } else {
        switch ($action) {
            case "like":
                $stmt->bind_param("iis", $userId, $answerId, $case);
                break;
            case "dislike":
                $stmt->bind_param("iis", $userId, $answerId, $case);
                break;
            case "unlike":
                $stmt->bind_param("ii", $userId, $answerId);
                break;
            case "undislike":
                $stmt->bind_param("ii", $userId, $answerId);
                break;
        }

        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo $e;
        }
    }

    $stmt->close();
    echo json_encode(["message" => "works!"]);
} else {
    header("Location: /index.php");
}
