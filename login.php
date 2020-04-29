<?php
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once("classes/Db.class.php");
include_once("classes/Login.class.php");


if (!empty($_POST)) {

	//$conn = @new mysqli("localhost", "root", "" /*"root"*/, "php2020");
	$email = $_POST['email'];
	$password = $_POST['password'];
	//set up email & password 
	$login = new Login();
	$login->setEmail($email);
	$login->setPassword($password);

	//check if email exists
	if ($login->userLogin() == true) {
		echo "You are in! :)";
		header('Location: index.php');
	} else {
		$error = "Sorry, we can't log you in with that email address and password. Can you try again?";
	};
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="Login">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

				<?php if (isset($error)) : ?>
					<div class="form__error">
						<p>
							<?php echo $error; ?>
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
				</div>
				<div>
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
					<p>No account yet?<a href="register.php"> Sign up here</a></p>
				</div>
			</form>
		</div>
	</div>
</body>

</html>