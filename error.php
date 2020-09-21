<?php
include './src/components/header.php';

if (isset($_GET['error'])) {
    print "<h1>" . $_GET['error'] . "</h1>";
} else {
    header("Location: ./index.php");
    exit();
}

include './src/components/footer.php';
