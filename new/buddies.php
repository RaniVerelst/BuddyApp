<?php
// FEATURE 13
// Display registered users and connections
include_once("classes/Db.class.php");
include_once("classes/Friendlist.class.php");
$allUsers = Friendlist::getAll();
$allFriends = Friendlist::getAllFriends();




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
    <div class="faq">
        <h1>BUDDIES</h1>

    </div>

    <div class="user_list row">
        <ul>
            <?php foreach ($allUsers as $a) : ?>
                <li class="col-sm-3"><?php echo $a['user_name'] ?></li>
                <input class="submit_signup  col-sm-3" type="submit" value="Stuur buddy verzoek">
            <?php endforeach ?>
        </ul>
    </div>
    </div>


    <div class="friend_list row">
        <h4>BUDS connecties</h4>

        <?php foreach ($allFriends as $a) : ?>
            <li class="col-sm-12"><?php echo $a['first_name'] . " is bevriend met " . $a['user2_id'] ?></li>
        <?php endforeach ?>


        <script src="app.js"></script>
    </div>
</body>

</html>




</body>

</html>