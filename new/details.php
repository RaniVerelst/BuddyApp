<?php
require_once(__DIR__ . "/classes/Details.class.php");
require_once(__DIR__ . "/classes/Db.class.php");

$userDetails = new UserDetails();

//get user_id
session_start();

if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];
    //find user id
    $userDetails->setCurrentUser($userEmail);
    $findUser = $userDetails->findUserId();
    $currentUser = $findUser[0];
}

// valideren of alle velden zijn ingevuld
if (!empty($_POST['submit'])) {

    try {
        $userDetails->setUserid($currentUser);
        var_dump($_SESSION['user_id']);


        $movie = $_POST['movie'];
        $destination = $_POST['destination'];
        $serie = $_POST['serie'];
        $cookie = $_POST['cookie'];
        $hangout = $_POST['hangout'];
        $class = $_POST['class'];
        $skills = $_POST['skills'];

        //characteristics
        $userDetails->setMovie($movie);
        $userDetails->getMovie();
        $userDetails->setDestination($destination);
        $userDetails->getDestination();
        $userDetails->setSerie($serie);
        $userDetails->getSerie();
        $userDetails->setcookie($cookie);
        $userDetails->getCookie();
        $userDetails->setHangout($hangout);
        $userDetails->getHangout();
        $userDetails->setUserid($currentUser);
        $userDetails->getUserid();
        $userDetails->setClass($class);
        $userDetails->getClass();
        $userDetails->setSkills($skills);
        $userDetails->getSkills();

        $userDetails->saveUserDetails();
    } catch (Exception $t) {
        $error =  $t->getMessage();
    }
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
                <h1> <img src="images/logo.png" width="200px" alt=""></h1>
            </div>
        </div>
    </div>

    <form name="register_form" class="form_signup" method="post" action="">

        <div class="row details">
            <div class="col-sm-12">
                <div class="details">
                    <div class="header">
                        <h3>Vervolledig je profiel</h3>
                        <p>Zo kunnen we je matchen met je ideale buddy</p>
                        <?php if (isset($errorClass)) : ?>
                            <p class="form__error"><?php echo $errorClass ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="input_signup">
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Buddy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Bud
                            </label>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" name="class" required="required">
                                <option selected disabled hidden>IMD jaar</option>
                                <option>1 IMD</option>
                                <option>2 IMD</option>
                                <option>3 IMD</option>
                            </select>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" name="skills">
                                <option selected disabled hidden>Passie voor...</option>
                                <option>Design</option>
                                <option>Development</option>
                                <option>Design & Development</option>

                            </select>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" input-md name="movie">
                                <option selected disabled hidden>Favoriete movie genre</option>
                                <option>Actie</option>
                                <option>Comedie</option>
                                <option>Fantasie</option>
                                <option>Horror</option>
                                <option>Romantiek</option>
                                <option>Sci-fi</option>
                                <option>Western</option>
                            </select>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" name="destination">
                                <option selected disabled hidden>Waar zou je graag naar toe reizen?</option>
                                <option>Belgium</option>
                                <option>Nepal</option>
                                <option>Norway</option>
                                <option>Japan</option>
                                <option>United States</option>
                                <option>Brazil</option>
                                <option>South Africa</option>
                            </select>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" name="serie">
                                <option selected disabled hidden>Meest nostalgische serie</option>
                                <option>W817</option>
                                <option>Samson & Gert</option>
                                <option>Beestenbos is boos</option>
                                <option>Peperbollen</option>
                                <option>Hey Arnold</option>
                                <option>Spring</option>
                                <option>De smurfen</option>
                            </select>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" name="cookie">
                                <option selected disabled hidden>Welke koek zou je niet kunnen missen?</option>

                                <option>Chocolat Chip Cookies</option>
                                <option>Oreo's</option>
                                <option>Jaffa Cakes</option>
                                <option>Wafel</option>
                                <option>Lange vingers</option>
                                <option>Dino koeken</option>
                            </select>
                        </div>
                        <div class="input_signup dropdown">
                            <select class="form-control input-md" name="hangout">
                                <option selected disabled hidden>Ik chill het liefst...</option>

                                <option>Thuis in mijn bed</option>
                                <option>School</option>
                                <option>Bij vrienden</option>
                                <option>In de natuur</option>
                                <option>Geheime plek</option>
                                <option>Café</option>
                            </select>
                        </div>
                    </div>

                    <!-- submit button -->
                    <input class="submit_signup" type="submit" name="submit" value="Complete profile">
                    <!--- skip process --></br>
                    <a class="skip" href="index.php">Andere keer</a>
                </div>
            </div>
        </div>
    </form>



</body>

</html>