
<?php
session_start();


if(isset($_POST['register'])){
   include('../pages/php/includes/dbfunction.php');
   $obj=new dbfunction();
  $obj->register($_POST['schoolid'],$_POST['pwd']);

}

 ?>


<!DOCTYPE html>

<html lang="en">
	<head>

		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
    <form method= "post">

		<hr style="border-top:1px dotted #ccc;"/>



				<h4 class="text-success">Register here...</h4>
				<hr style="border-top:1px groovy #000;">

					<label>School ID</label>
					<input type="text" class="form-control" name="schoolid" id="schoolid" />

<br>
					<label>Password</label>
					<input type="password" class="form-control" name="pwd"  id="pwd" />
				<br />

					<button name="register" id="register" type="submit" >Register</button>

				<a href="login-index.php">Login</a>
			</form>
</body>
</html>
