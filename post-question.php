<?php include './src/components/header.php' ?>

<div class="form p-5">
    <form action="./src/includes/post-question.inc.php" method="POST">
        <h1>Ask a question</h1>
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="text" placeholder="Message" rows="14"></textarea>
        </div>
        <div class="form-group text-center">
            <button name="submit-question" class="btn btn-primary" type="submit">Ask Question</button>
        </div>
    </form>
</div>

<?php include './src/components/footer.php' ?>