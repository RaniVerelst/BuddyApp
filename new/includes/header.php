<?php

include_once("classes/Db.class.php");
session_start();

if (isset($_SESSION["user_id"])) {
  $sesstionIsSet = true;
  $currentUser = $_SESSION["user_id"];
} else {
  $extram =  'nope';
  $sesstionIsSet = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buddy App</title>
  <link href="startbootstrap/css/freelancer.min.css" type="text/css" rel="stylesheet">
  <link href="style/style.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,600,900&display=swap" rel="stylesheet">


</head>

<body>

</body>

</html>

<!-- Navigation -->
<div class="well">
  <div class="row">
    <div class="col-lg-6">
      <img src="images/logo.png" width="100px" alt="">
    </div>


    <div class="col-lg-6 headnav ">
      <div class="row">
        <ul class="nav ">
          <div>

            <li><a href="index.php">HOME</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="buddies.php">BUDDIES</a></li>
            <li><a href="ajax-chat.php">BERICHTEN</a></li>
            <li><a href="rooms.php">LOKALEN</a></li>
            <li><a href="#">PROFIEL</a></li>
            <li class="log"><a href="<?php if ($sesstionIsSet) {
                                        echo "logout.php";
                                      } else {
                                        echo "login.php";
                                      } ?>"> LOG <?php if ($sesstionIsSet) {
                                                    echo 'OUT';
                                                  } else {
                                                    echo 'IN';
                                                  }  ?></a></a></li>
        </ul>
      </div>

      </nav>
    </div>
  </div>
</div>