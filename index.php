<?php include './src/components/header.php'; ?>


<?php
if (isset($_SESSION['username'])) {
    echo "<h1>You are logged in</h1>";
} else {
    echo "<h1>You are logged out</h1>";
}
?>





<?php include './src/components/footer.php'; ?>