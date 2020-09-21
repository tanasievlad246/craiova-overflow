<?php
if (isset($_POST['login'])) {
    require 'dbh.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?"; //OR username=? -> to log in with username also
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header('Location: http://localhost/craiova-overflow/index.php?error=SQL+Error');
        exit();
    } else {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $passwordCheck = password_verify($password, $row['password']);
            if ($passwordCheck == false) {
                header('Location: http://localhost/craiova-overflow/index.php?error=Email+or+password+incorrect');
                exit();
            } else if ($passwordCheck == true) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['joined'] = $row['joined'];

                header('Location: http://localhost/craiova-overflow/index.php?login=success');
                exit();
            } else {
                header('Location: http://localhost/craiova-overflow/index.php?error=Email+or+password+incorrect');
                exit();
            }
        } else {
            header('Location: http://localhost/craiova-overflow/index.php?error=Email+or+password+incorrect');
            exit();
        }
    }


    header('Location: http://localhost/craiova-overflow/index.php');
    exit();
}
