<?php include './src/components/header.php'; ?>


<div class="m-auto w-75 ">
    <div class="row justify-content-center border-bottom border-left border-right border-dark p-2">
    <a <?php if (isset($_SESSION['username'])) { ?> 
            href="post-question.php" 
        <?php } else {?> 
            href="register.php" <?php } ?>
        class="btn btn-success">Ask question</a>
    </div>
    <div class="row justify-content-center border-dark">
        <table class="table table-striped table-bordered text-center">
            <?php 
            include 'src/includes/dbh.inc.php';

            $sql = "SELECT question_id, title, date FROM questions ORDER BY date desc";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                print "<h3>Error connecting to the database</h3>";
            } else {
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    print <<< EOS
                        <tr>
                            <td class="w-75"><a href="question.php?id={$row['question_id']}" class="lead text-dark nav-link p-0 font-weight-bold">{$row["title"]}</a></td>
                            <td class="font-weight-bold">{$row["date"]}</td>
                        </tr>
                    EOS;
                }

            }

            ?>
        </table>
    </div>
</div>


<?php include './src/components/footer.php'; ?>