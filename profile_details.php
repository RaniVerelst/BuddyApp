<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("classes/Userdetails.class.php");
require_once("classes/Db.class.php");
require_once("classes/User.class.php");

// valideren of alle velden zijn ingevuld
if (!empty($_POST)) {


    try {
        session_start();
        $movie = $_POST['movie'];
        $destination = $_POST['destination'];
        $serie = $_POST['serie'];
        $cookie = $_POST['cookie'];
        $hangout = $_POST['hangout'];

        $UserDetails = new UserDetails();

        $UserDetails->setMovie($movie);
        $UserDetails->getMovie();
        $UserDetails->setDestination($destination);
        $UserDetails->getDestination();
        $UserDetails->setSerie($serie);
        $UserDetails->getSerie();
        $UserDetails->setcookie($cookie);
        $UserDetails->getCookie();
        $UserDetails->setHangout($hangout);
        $UserDetails->getHangout();


        $UserDetails->saveUserDetails();
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
// alles in orde? dan zullen we werken met getters en setters binnen UserDetails.class.php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complete profile</title>
    <link rel="stylesheet" href="css/reset.css"  rel="stylesheet">
    <link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" rel="stylesheet">
</head>

<body>
    <form name="register_form" class="form_signup" method="post" action="">
        <h1>Complete your account</h1>
        <h2>so we can match you with the perfect buddy.</h2>
        <div class="input_signup">
            <h3>What class are you in?</h3>
            <div class="form-check">
                <label class="form-check-label" for="imd1"> IMD1 </label>
                <input class="form-check-input" type="checkbox" name="imd1" value="imd1" id="imd1">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="imd2"> IMD2 </label>
                <input class="form-check-input" type="checkbox" name="imd2" value="imd2" id="imd2">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="imd3"> IMD3 </label>
                <input class="form-check-input" type="checkbox"  name="imd3" value="imd3" id="imd3">
            </div>
        </div>
        <div class="input_signup">
            <h3>What do you like?</h3>
            <div class="input_signup dropdown">
                <label for="movies">Favorite movie genre</label>
                <select name="movie">
                    <option>Action</option>
                    <option>Comedy</option>
                    <option>Fantasy</option>
                    <option>Horror</option>
                    <option>Romance</option>
                    <option>Sci-fi</option>
                    <option>Western</option>
                </select>
            </div>
            <div class="input_signup dropdown">
                <label for="destination">Favorite destination</label>
                <select name="destination">
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
                <label for="serie">Favorite KETNET serie</label>
                <select name="serie">
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
                <label for="cookie">Favorite cookie</label>
                <select name="cookie">
                    <option>Chocolat Chip Cookies</option>
                    <option>Oreo's</option>
                    <option>Jaffa Cakes</option>
                    <option>Waffle</option>
                    <option>Lange vingers</option>
                    <option>Dino cookies</option>
                </select>
            </div>
            <div class="input_signup dropdown">
                <label for="hangout">Favorite hangout spot</label>
                <select name="hangout">
                    <option>At home in bed</option>
                    <option>School</option>
                    <option>Friend's home</option>
                    <option>In the woods</option>
                    <option>Secret spot</option>
                    <option>Bar</option>
                    <option>With the homies</option>
                </select>
            </div>
        </div>


        <!-- submit button -->
        <input class="submit_signup" type="submit" value="Complete profile">
    </form>

</body>


</html>