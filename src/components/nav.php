<nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand" href="../index.php">Craiova Overflow</a>
	<div>
		<form action="src/includes/login.inc.php" method="POST" class="form-inline float-left mr-2">
			<div class="form-group">
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" required>
			</div>
			<div class="form-group ml-1">
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="password" required>
			</div>
			<button type="submit" class="btn btn-primary ml-2">Login</button>
		</form>
		<div class="float-left">
			<a name="Register" value="Register" class="btn btn-outline-success ml-2" href="src/register.php">Register</a>
			<form action="" class="float-left">
				<input type="submit" name="logout" value="Logout" class="btn btn-outline-success" />
			</form>
		</div>
	</div>
</nav>