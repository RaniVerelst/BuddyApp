<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("classes/User.class.php");
require_once("classes/Db.class.php");

// valideren of alle velden zijn ingevuld
if (!empty($_POST)) {
  try {
    //return true;
    // sessie opstarten
    session_start();
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $user = new User();
    $user->setFirstname($firstname);
    $user->getFirstname();
    $user->setLastname($lastname);
    $user->getLastname();
    $user->setUsername($username);
    $user->getUsername();
    $user->setEmail($email);
    $user->getEmail();
    $user->setPassword($password);
    $user->getPassword();
    $user->setPasswordconfirm($password_confirm);
    $user->getPasswordconfirm();

    $result = $user->register();
  } catch (Exception $t) {
    $error =  $t->getMessage();
  }
} else {
  // foutboodschap tonen
  $empty_field_error = "Please, fill in all the fields";
}

// alles in orde? dan zullen we werken met getters en setters binnen User.class.php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign up</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
</head>

<body>
  <form name="register_form" class="form_signup" method="post" action="">
    <h1>Create your account</h1>
    <!-- foutboodschap wanneer niet alle velden zijn ingevuld -->
    <?php if (isset($error)) : ?>
      <div class="error_signup"><?php echo $error; ?></div>
    <?php endif; ?>
    <!-- firstname -->
    <div class="input_signup">
      <input type="text" name="firstname" value="" placeholder="First name">
    </div>

    <!-- lastname -->
    <div class="input_signup">
      <input type="text" name="lastname" value="" placeholder="Last name">
    </div>

    <!-- username -->
    <div class="input_signup">
      <input type="text" name="username" value="" placeholder="User name">
    </div>

    <!-- e-mail -->
    <div class="input_signup">
      <input type="text" name="email" placeholder="Email @student.thomasmore.be">
    </div>

    <!-- password -->
    <div class="input_signup">
      <input type="password" name="password" value="" placeholder="Password">
      <p>Your password need at least 8 characters</p>
    </div>

    <!-- confirm password -->
    <div class="input_signup">
      <input type="password" name="password_confirm" value="" placeholder="Confirm Password">
    </div>


    <!-- submit button -->
    <input class="submit_signup" type="submit" value="Sign up">

    <div class="link_to_login">
      <p>Do you already have an account?<a href="login.php">Sign in here</a></p>
    </div>
  </form>

</body>


</html>