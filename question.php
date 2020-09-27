<?php include './src/components/header.php';



if (isset($_GET['qid'])) {
    include './src/includes/dbh.inc.php';
    if (isset($_SESSION['user_id'])) {
        $user = new User($_SESSION['user_id']);
    }
    $sql = 'SELECT question_id, title, body, owner_user FROM questions WHERE question_id=?';
    if (isset($conn)) {
        $stmt = $conn->prepare($sql);
    }

    if (!$stmt) {
        header("Location: http://localhost/craiova-overflow/question.php?error=SQL+Error");
        exit();
    } else {
        $stmt->bind_param("i", $_GET['qid']);
        $stmt->execute();
        $question = $stmt->get_result()->fetch_assoc();
    }
}
?>

<div>
    <?php if (!$question) : ?>
        <div class="mx-auto p-5 text-center">
            <h1>Question not found</h1>
        </div>
    <?php else : ?>
        <div class="p-5 w-50 mx-auto">
            <div class="row">
                <div class="ml-4">
                    <h2><?= $question['title'] ?></h2>
                    <small class="blockquote-footer"><?= $question['owner_user'] ?></small>
                </div>
            </div>
            <div class="row border-bottom border-dark mx-auto">
                <div class="p-2">
                    <p class="lead ml-3"><?= $question['body'] ?></p>
                </div>
            </div>
            <!-- Row for rendering answers -->
            <div>
                <?php
                $sql = "SELECT answer_id, body, username, user_id, question_id FROM answers WHERE question_id=?";
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    header("Location: http://localhost/craiova-overflow/question.php?error=SQL+Error");
                    exit();
                } else {
                    $stmt->bind_param("i", $_GET['qid']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }
                while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="p-2 border-bottom border-success">
                        <p><?= $row['body'] ?></p>
                        <small class="blockquote-footer"><?= $row['username'] ?></small>
                        <!-- Check if the user liked the given answer -->
                        <div class="rating-div">
                            <button <?php if ($user->userLiked($row['answer_id']) > 0) : ?> class="btn btn-success like-btn" name="unlike" <?php else : ?> class="btn btn-main like-btn" name="like" <?php endif ?> data-id="<?= $row['answer_id'] ?>"><i class="fas fa-arrow-up"></i></button>
                            <button <?php if ($user->userDisliked($row['answer_id']) > 0) : ?> class="btn btn-danger dislike-btn" name="undislike" <?php else : ?> class="btn btn-main dislike-btn" name="dislike" <?php endif ?> data-id="<?= $row['answer_id'] ?>"><i class="fas fa-arrow-down"></i></button>
                            <?php
                            $sql = "SELECT COUNT(rating_action) FROM rating_info WHERE answer_id=? AND rating_action='like'";
                            $aId = $row['answer_id'];
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('i', $aId);
                            $stmt->execute();
                            $likes = $stmt->get_result()->fetch_assoc();
                            $sql = "SELECT COUNT(rating_action) FROM rating_info WHERE answer_id=? AND rating_action='dislike'";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param('i', $aId);
                            $stmt->execute();
                            $dislikes = $stmt->get_result()->fetch_assoc();
                            $rating = $likes["COUNT(rating_action)"] - $dislikes["COUNT(rating_action)"];
                            ?>
                            <!-- Shows the rating of a answer that is likes minus dislikes -->
                            <small class="rating"><?php print $rating ?></small>
                        </div>


                    </div>
                <?php } ?>
            </div>
            <div class="row text-center">
                <div class="mx-auto p-5">
                    <form action="./src/includes/answer.inc.php" method="post" class="form">
                        <h3>Leave an answer</h3>
                        <div class="form-group">
                            <textarea name="answer-text" id="answer-text" class="form-control" rows="10" cols="100" placeholder="Answer"></textarea>
                        </div>
                        <div class="form-group">
                            <input name="answer-submit" type="submit" value="Answer" class="btn btn-primary">
                        </div>
                        <input type="hidden" name="question_id" value="<?= $question['question_id'] ?>" />
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include './src/components/footer.php'; ?>