<?php include './src/components/header.php';
if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $joined = $_SESSION['joined'];

    print <<< EOS
        <div class="text-center">
            <h2>Username: $username</h2>
            <h2>Email: $email</h2>
            <h2>Date joined: $joined</h2>
        </div>
    EOS;
} else {
    header("Location: http://localhost/craiova-overflow/register.php?error=You+to+be+logged+in");
}

include './src/components/footer.php';
