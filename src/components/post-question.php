<?php include 'header.php' ?>

<div>
    <form action="../includes/post-question.php" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Ask</button>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>