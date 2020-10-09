<?php include 'src/components/header.php'; ?>

<?php
if (isset($_GET['qid']) && isset($_SESSION['user_id'])) {
    $questionToEdit = Question::getQuestion($_GET['qid']);
} else {
    header("Location: index.php");
    exit();
}
?>

    <div class="form p-5">
        <form action="./src/includes/update-question.inc.php" method="POST">
            <h1>Edit question</h1>
            <div class="form-group">
                <input type="text" class="form-control" name="title" placeholder="Title" value="<?= $questionToEdit['title']?>">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="body" placeholder="Question body" rows="14"><?= $questionToEdit['title']?></textarea>
            </div>
            <div class="form-group text-center">
                <input type="hidden" name="question_id" value="<?= $questionToEdit['question_id'] ?>" />
                <button name="update" class="btn btn-info" type="submit">Update</button>
            </div>
        </form>
    </div>

<?php include 'src/components/footer.php'; ?>