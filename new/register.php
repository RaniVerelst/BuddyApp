<?php include_once(__DIR__ . "/classes/Db.class.php");
include_once(__DIR__ . "/classes/User.class.php");
if (!empty($_POST)) {
    try {
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
                        <input class="form-control input-md" type="text" name="firstname" value="" placeholder="Voornaam">
                    </div>

                    <!-- lastname -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="lastname" value="" placeholder="Achternaam">
                    </div>

                    <!-- username -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" id="username" name="username" value="" placeholder="Gebruikersnaam" onkeyup="checkname();">
                        <p id="name_status"></p>
                    </div>

                    <!-- e-mail -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="text" name="email" placeholder="Email @student.thomasmore.be">
                    </div>

                    <!-- password -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="password" name="password" value="" placeholder="Passwoord">
                        <p>Passwoord moet minstens 8 karakters lang zijn.</p>
                    </div>

                    <!-- confirm password -->
                    <div class="input_signup">
                        <input class="form-control input-md" type="password" name="password_confirm" value="" placeholder="Bevestig Passwoord">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function checkname() {
        var name = document.getElementById("username").value;

        if (name) {
            $.ajax({
                type: 'post',
                url: 'check.php',
                data: {
                    user_name: name,
                },
                success: function(response) {
                    $('#name_status').html(response);

                }
            });
        } else {
            $('#name_status').html("");
            return false;
        }
    }
</script>