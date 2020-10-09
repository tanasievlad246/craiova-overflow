<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="/go-ask/index.php">GoAsk</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
		<?php if (!isset($_SESSION['username'])) { ?>
            <li>
			<form action="src/includes/login.inc.php" method="POST" class="form-inline float-left mr-2 login-form">
				<div class="form-group">
					<input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" required>
				</div>
				<div class="form-group ml-1">
					<input name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="password" required>
				</div>
				<button name='login' type="submit" class="btn btn-primary ml-2">Login</button>
			</form>
            </li>
            <li><a name="Login" value="Login" class="btn btn-outline-success nav-button nav-login-link" href="login.php">Login</a></li>
            <li><a name="Register" value="Register" class="btn btn-outline-success nav-button" href="register.php">Register</a></li>
		<?php } else { ?>
			<div class="float-left">
				<form action="./src/includes/logout.inc.php" class="float-left mr-2">
					<input type="submit" name="logout" value="Logout" class="btn btn-outline-success" />
				</form>
				<a href="profile.php" class="btn btn-outline-success">Profile</a>
			</div>
		<?php } ?>
        </ul>
	</div>
</nav>