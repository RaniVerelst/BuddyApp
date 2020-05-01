<?php
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once("classes/Db.class.php");
include_once("classes/Login.class.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Local</title>
</head>

<body>
    <div>
        <?php include("header.php") ?>
        <h1>find a room</h1>
    </div>

    <section>
        <form class="search" method="get" action="">
            <input class="input_search" type="text" name="search" placeholder="find a room">
            <input class="btn_search" type="submit" value="">
        </form>
    </section>

</body>

</html>