<?php include './src/components/header.php';

if (isset($_GET['qid'])) {

    $question = Question::getQuestion($_GET['qid']);
}

?>

<div>
    <?php if (!$question) : ?>
        <div class="mx-auto p-5 text-center">
            <h1>Question not found</h1>
        </div>
    <?php else : ?>
        <div class="p-5 w-50 mx-auto question-content">
            <div class="row">
                <div class="ml-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['user_id'] == $question['user_id']): ?>
                            <a class="btn btn-primary" href="./edit-question.php?qid=<?=$_GET['qid']?>">Edit</a>
                        <?php endif; ?>
                    <?php endif; ?>
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

                $answers = Answer::getAllAnswersForQuestion($_GET['qid']);
                foreach ($answers as $row) {
                ?>
                    <div class="p-2 border-bottom border-success">
                        <p><?= $row['body'] ?></p>
                        <small class="blockquote-footer"><?= $row['username'] ?></small>
                        <!-- Check if the user liked the given answer -->
                        <div class="rating-div">
                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <button <?php if (User::userLiked($row['answer_id'], $_SESSION['user_id']) > 0) : ?> class="btn btn-success like-btn" name="unlike" <?php else : ?> class="btn btn-main like-btn" name="like" <?php endif ?> data-id="<?= $row['answer_id'] ?>"><i class="fas fa-arrow-up"></i></button>
                                <button <?php if (User::userDisliked($row['answer_id'], $_SESSION['user_id']) > 0) : ?> class="btn btn-danger dislike-btn" name="undislike" <?php else : ?> class="btn btn-main dislike-btn" name="dislike" <?php endif ?> data-id="<?= $row['answer_id'] ?>"><i class="fas fa-arrow-down"></i></button>
                            <?php else : ?>
                                <button class="btn btn-main like-btn"><i class="fas fa-arrow-up"></i></button>
                                <button class="btn btn-main dislike-btn"><i class="fas fa-arrow-down"></i></button>
                            <?php endif; ?>
                            <?php

                            $rating = Answer::getRating($row['answer_id']);

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
<!--<script src="public/javascript/rating.js"></script>-->
<?php include './src/components/footer.php'; ?>

