<?php
if (isset($_POST['login'])) {
    require '../classes/User.class.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = User::login($email, $password);

    if ($login) {
        header('Location: ../../index.php?message=Login+successful');
        exit();
    } else {
        header('Location: ../../login.php?error=Wrong+username+or+password');
        exit();
    }
}
