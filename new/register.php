<?php include_once(__DIR__ . "/classes/Db.class.php");
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
                <h1> <img src="images/logo.png" width="200px" alt=""></h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="register">
                <div class="header">
                    <h3>Maak een nieuw account aan</h3>
                </div>
                <div class="1-part">
                </div>
                <form name="register_form" class="form_signup" method="post" action="">
                    <!-- foutboodschap wanneer niet alle velden zijn ingevuld -->
                    <?php if (isset($error)) : ?>
                        <div class="error_signup"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <!-- firstname -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="firstname" value="" placeholder="First name">
                    </div>

                    <!-- lastname -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="lastname" value="" placeholder="Last name">
                    </div>

                    <!-- username -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="username" value="" placeholder="User name">
                    </div>

                    <!-- e-mail -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="email" placeholder="Email @student.thomasmore.be">
                    </div>

                    <!-- password -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="password" name="password" value="" placeholder="Password">
                        <p>Your password need at least 8 characters</p>
                    </div>

                    <!-- confirm password -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="password" name="password_confirm" value="" placeholder="Confirm Password">
                    </div>


                    <!-- submit button -->
                    <input class="submit_signup" type="submit" value="Registreer">

                    <div class="login">
                        <p>Heb je al een account?<a href="login.php"> Log hier in</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>

</body>

</html>