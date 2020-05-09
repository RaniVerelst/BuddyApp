<?php
// FEATURE 13
// Display registered users and connections
include_once("classes/Db.class.php");
include_once("classes/Friendlist.class.php");

$users = new Friendlist();


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

    <title>Buddy App</title>
</head>

<body>
    <?php include_once("includes/header.php") ?>


    <div class="centered index">
        <div class="text-center">
            <h1>WELKOM BIJ BUDS </h1>
            <p>Vind een leuke buddy om je wegwijs te maken in het IMD leven.</p>
            <p> Heb je het IMD leven al helemaal onder de knie?</br>Word dan als Buddy het aanspreekpunt voor de
                nieuwelingen in het vak.
            </p>
        </div>
    </div>


    <div class="row index justify-content-center ">
        <div class="col-lg-3 text-center">
        </div>
        <div class=" countr col-lg-3 text-center">
            <p class="count"><?php echo $users->countUsers(); ?> </p>
            <p class="strong">actieve buddys</p>
        </div>
        <div class=" countr col-lg-3 text-center">
            <p class="count"><?php echo $users->countConnections(); ?> </p>

            <p>buddy connecties 4 life gemaakt</p>

        </div>
        <div class="col-lg-3 text-center">
        </div>
    </div>

    <div class="maybefriends">
        <h4>VOORGESTELD VOOR JOU</h4>

    </div>

</body>

</html>