<?php include './src/components/header.php'; ?>

<form action="src/includes/login.inc.php" method="POST" class="form p-5 w-50 mx-auto login-page">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" required>
    </div>
    <div class="form-group ml-1">
        <label for="exampleInputPassword1">Password</label>
        <input name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="password" required>
    </div>
    <button name='login' type="submit" class="btn btn-primary ml-2">Login</button>
    <a href="register.php">Register here!</a>
</form>

<?php include './src/components/footer.php'; ?>