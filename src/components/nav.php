<nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand" href="/craiova-overflow/index.php">Craiova Overflow</a>
	<div>
		<?php if (!isset($_SESSION['username'])) { ?>
			<form action="src/includes/login.inc.php" method="POST" class="form-inline float-left mr-2">
				<div class="form-group">
					<input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" required>
				</div>
				<div class="form-group ml-1">
					<input name='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="password" required>
				</div>
				<button name='login' type="submit" class="btn btn-primary ml-2">Login</button>
			</form>
			<a name="Register" value="Register" class="btn btn-outline-success" href="src/register.php">Register</a>
		<?php } else { ?>
			<div class="float-left">
				<form action="src/includes/logout.inc.php" class="float-left mr-2">
					<input type="submit" name="logout" value="Logout" class="btn btn-outline-success" />
				</form>
				<a href="src/components/profile.php" class="btn btn-outline-success">Profile</a>
			</div>
		<?php } ?>
	</div>
</nav>