<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
include_once("classes/User.class.php");
include_once("classes/Db.class.php");

session_start();

if (isset($_SESSION["user_id"])) {
  $sesstionIsSet = true;
  $currentUser = $_SESSION["user_id"];
} else {
  $extram =  'nope';
  $sesstionIsSet = false;
  $currentUser = 15;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buddy App</title>
  <link href="startbootstrap/css/freelancer.min.css" type="text/css" rel="stylesheet">
  <link href="css/style.css" type="text/css" rel="stylesheet">

</head>

<body>

</body>

</html>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">Buds</a>
    <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Home</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="chat/ajax-chat.html">Q&A-Webchat</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="room.php">
            <!-- Lokaal- & Campus-wegwijzer--> Find Your Way </a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="edit_profile.php">Edit Profile</a>
        </li>
        <li class="nav-item mx-0 mx-lg-1">
          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?php if ($sesstionIsSet) {
                                                                                  echo "logout.php";
                                                                                } else {
                                                                                  echo "login.php";
                                                                                } ?>"> Log <?php if ($sesstionIsSet) {
                                                                                              echo 'out';
                                                                                            } else {
                                                                                              echo 'in';
                                                                                            }  ?></a>
        </li>
      </ul>
    </div>
  </div>
  <form class="search" method="get" action="search.php">
    <input class="input_search" type="text" name="search" placeholder="Search a user or characteristic">
    <input class="btn_search" type="submit" value="">
  </form>
</nav>