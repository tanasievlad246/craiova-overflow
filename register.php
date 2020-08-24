<?php include './src/components/header.php'; ?>

<form action="src/includes/register.inc.php" method="POST"> 
	<div class="form-group">
    	<label for="exampleInputEmail1">Email address</label>
    	<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  	</div>
  	<div class="form-group">
    	<label for="exampleInputUsername1">Username</label>
    	<input type="text" class="form-control" id="exampleInputUsername1" required>
  	</div>
  	<div class="form-group">
    	<label for="exampleInputPassword1">Password</label>
    	<input type="password" class="form-control" id="exampleInputPassword1" required>
  	</div>
  	<button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php include './src/components/footer.php'; ?>