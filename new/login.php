<?php include_once(__DIR__ . "/classes/Db.class.php");
include_once(__DIR__ . "/classes/Login.class.php");
if (!empty($_POST)) {
    try {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = new Login();

        $login->setEmail($email);
        $login->getEmail();
        $login->setPassword($password);
        $login->getPassword();


        $result = $login->userLogin();
        var_dump($_SESSION);
    } catch (Exception $t) {
        $error =  $t->getMessage();
    }
} else {
    // foutboodschap tonen
    $empty_field_error = "Please, fill in all the fields";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="startbootstrap/css/freelancer.min.css" type="text/css" rel="stylesheet">
    <link href="style/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,900&display=swap" rel="stylesheet">

    <title>BUDS</title>
</head>

<body>
    <div class="row">
        <div class="col-lg-12  ">
            <div class="well headermain">
                <h1> <img src="images/logo.png" width="140px" alt=""></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="register">
                <div class="header">
                    <h3>Login</h3>
                </div>
                <div class="1-part">
                </div>
                <form name="register_form" class="form_signup" method="post" action="">
                    <!-- foutboodschap wanneer niet alle velden zijn ingevuld -->
                    <?php if (isset($error)) : ?>
                        <div class="error_signup"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <!-- e-mail -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="email" placeholder="Email @student.thomasmore.be">
                    </div>

                    <!-- password -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="password" name="password" value="" placeholder="Passwoord">
                    </div>


                    <!-- submit button -->
                    <input class="submit_signup" type="submit" value="Login">

                    <div class="login">
                        <p>Heb je nog geen account?<a href="register.php"> Registreer je hier</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

</body>

</html>