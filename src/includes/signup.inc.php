<?php
if (isset($_POST['submit'])) {
    include '../classes/User.class.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $user = new User($username, $password, $email);

    if ($user->register() == true) {
        header("Location: ../../index.php?message=Register+successful");
        exit();
    } else {
        header("Location: ../../index.php?error=" . $user->register());
        exit();
    }
} else {
    header("Location: ../../register.php");
    exit();
}
