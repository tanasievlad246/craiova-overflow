<?php
if (isset($_POST['submit'])) {
    $host = '127.0.0.1';
    $port = '3306';
    $username = 'root';
    $password = 'fortuna246';
    $dbName = 'craiovaOverflow';

    $conn = new mysqli($host, $username, $password, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location: http://localhost/craiova-overflow/src/register.php?error=sqlError");
        exit();
    } else {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: http://localhost/craiova-overflow/src/register.php?error=usernameNotUnique");
            exit();
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"; // ? placeholder for prepeared statements
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                header("Location: http://localhost/craiova-overflow/src/register.php?error=sqlError");
                exit();
            } else {
                $hashPwd = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $username, $email, $hashPwd);
                $stmt->execute();
                // mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashPwd); // replaces ? in the query
                // mysqli_stmt_execute($stmt);

                header("Location: http://localhost/craiova-overflow/src/register.php?success=registered");
                exit();
            }
        }
    }
    $stmt->close();
} else {
    header("Location: http://localhost/craiova-overflow/src/register.php");
    exit();
}
