
<?php
session_start();


if(isset($_POST['register'])){
  include('../pages/php/includes/dbfunction.php');
  $obj=new dbfunction();
  $obj->register($_POST['schoolid'],$_POST['pwd'],$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['cnum']);
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

					<label>Firstname</label>
					<input type="text" class="form-control" name="fname" />
        <br>

          <label>Ln</label>
          <input type="text" class="form-control" name="lname" />
        <br>

          <label>School ID</label>
          <input type="text" class="form-control" name="schoolid"/>
        <br>

          <label>cnum</label>
          <input type="text" class="form-control" name="cnum"  />
        <br>

          <label>email</label>
          <input type="text" class="form-control" name="email"  />
        <br>

					<label>Password</label>
					<input type="password" class="form-control" name="pwd"  />
				<br />

					<button name="register" type="submit" >Register</button>

				<a href="login-index.php">Login</a>
			</form>
</body>
</html>
