<?php include './src/components/header.php'; ?>

<form action="./src/includes/signup.inc.php" method="post" class="form p-5 w-50 mx-auto">
	<div class="form-group">
		<label for="exampleInputEmail1">Email address</label>
		<input name="email" type="email" class="form-control" id="exampleInputEmail1" required>
	</div>
	<div class="form-group">
		<label for="exampleInputUsername1">Username</label>
		<input name="username" type="text" class="form-control" id="exampleInputUsername1" required>
	</div>
	<div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
	</div>
	<input name="submit" value="Submit" type="submit" class="btn btn-primary" />
</form>


<?php include './src/components/footer.php'; ?>