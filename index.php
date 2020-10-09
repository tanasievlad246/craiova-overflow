<?php
include './src/components/header.php';
include './src/classes/Question.class.php';
?>


<div class="m-auto w-75 index-content">
    <div class="row justify-content-center border-bottom border-left border-right border-dark p-2">
        <a <?php if (isset($_SESSION['username'])) { ?> href="post-question.php" <?php } else { ?> href="register.php" <?php } ?> class="btn btn-success">Ask question</a>
    </div>
    <div class="row justify-content-center border-dark">
        <table class="table table-striped table-bordered text-center">
            <?php
            $questions = Question::getAllQuestions();

            foreach ($questions as $row) {
                print <<< EOS
                         <tr>
                             <td class="w-75"><a href="question.php?qid={$row['question_id']}" class="lead text-dark nav-link p-0 font-weight-bold">{$row["title"]}</a></td>
                             <td class="font-weight-bold date-cell">{$row["date"]}</td>
                         </tr>
                     EOS;
            }
            ?>
        </table>
    </div>
</div>


<?php include './src/components/footer.php'; ?>