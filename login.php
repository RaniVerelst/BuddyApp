
<?php
ini_set('display_startup_errors',1); error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');	
include_once("classes/User.class.php");
include_once("classes/Db.class.php");


if (!empty ($_POST) ){
	$conn = @new mysqli("localhost", "root", "root", "php2020");
	$email = $conn->real_escape_string($_POST['email']);
	$password = $_POST['password'];
	/* $options = [
		"cost" => 12 // 2^12
		];
	$password_hash = password_hash($password,PASSWORD_DEFAULT,$options);
	*/
	$sql =  "SELECT * FROM `users` WHERE `email`= '$email' and `password`= '$password'";
	$result = $conn->query($sql);
	if($result->num_rows == 1 /* && password_verify($password, $password_hash) */){
		header('Location: index.php');
	} else {
		echo "Sorry, we can't log you in with that email address and password. Can you try again?";
		; 
	}
	/*
	$hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
	if (password_verify($password, $hash)) {
		header('Location: index.php');
	} else {
		echo "Sorry, we can't log you in with that email address and password. Can you try again?";
	}
	*/
}


?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
</head>
<body>
	<div class="Login">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

				<?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
				</div>

				<div>
					<p>No account yet?<a href="register.php">Sign up here</a></p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
