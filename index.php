<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once("classes/User.class.php");
include_once("classes/Db.class.php");
include_once("header.php");

//if user is active display other header
if($sesstionIsSet){
    include_once('ask_feedback.php');
    } else { 
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Buddy App</title>

  <!-- Custom fonts for this theme -->
  <link href="startbootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="startbootstrap/css/freelancer.min.css" type="text/css" rel="stylesheet">
  <link href="css/style.css" type="text/css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->

  <!-- Masthead -->
  <header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">

      <!-- Masthead Avatar Image -->
      <img class="masthead-avatar mb-5" src="startbootstrap/img/avataaars.svg" alt="">

      <!-- Masthead Heading -->
      <h1 class="masthead-heading text-uppercase mb-0">Buddy App</h1>

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="divider-custom-line"></div>
      </div>
      <?php } ?>
      <!-- Masthead Subheading -->
      <p class="masthead-subheading font-weight-light mb-0">Find your Buddy!</p>
      <!---- Included feature 13 displays number of all users and connections made ------>
      <?php include_once("users_counter.php") ?>
    </div>
  </header>
  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="startbootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="startbootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="startbootstrap/js/jqBootstrapValidation.js"></script>
  <script src="startbootstrap/js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="startbootstrap/js/freelancer.min.js"></script>
</body>
</html>