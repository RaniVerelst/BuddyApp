<?php
include_once ("login.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        // access
        $secretKey = '6LdeKfQUAAAAAPjUll6-8lEm8Ys6hP2iNIHEnhoK';
        $captcha = $_POST['g-recaptcha-response'];
        
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
  } 
?>
