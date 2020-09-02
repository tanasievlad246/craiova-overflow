<?php include 'header.php' ?>

<div class="post-form form">
    <form action="../includes/post-question.php" method="POST">
        <h1>Ask a question</h1>
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea>
        </div>
        <div class="form-group justify-content-center">
            <button class="btn btn-primary" type="submit">Ask Question</button>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>