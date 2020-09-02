<?php include './src/components/header.php'; ?>


<div class="m-auto w-75 border-left border-right border-dark">
    <div class="row justify-content-center border-bottom border-dark p-2 mx-0">
    <a <?php if (isset($_SESSION['username'])) { ?> 
            href="src/components/post-question.php" 
        <?php } else {?> 
            href="src/register.php" <?php } ?>
        class="btn btn-success">Ask question</a>
    </div>
    <div class="row justify-content-center">
        <h3>Questions section</h3>
    </div>
</div>





<?php include './src/components/footer.php'; ?>