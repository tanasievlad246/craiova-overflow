<?php
if (isset($_POST['login'])) {
    require 'dbh.inc.php';
    require '../classes/User.class.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = User::login($email, $password);

    if ($login) {
        header('Location: http://localhost/craiova-overflow/index.php?message=Login+successful');
        exit();
    } else {
        header('Location: http://localhost/craiova-overflow/login.php?error=Wrong+username+or+password');
        exit();
    }
}
