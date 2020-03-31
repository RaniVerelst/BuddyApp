<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("classes/db.class.php");
include_once("classes/User.class.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Search</title>
</head>
<body>

    <div class="search_results">
      <h1>No results found</h1>
      <nav>
        <a href="#" id="href_post">X (<?php  ?>)</a>
        <a href="#" id="href_user">Users (<?php  ?>)</a>
      </nav>
      <!--Toont de zoekresultaten van de posts -->
        <div id="post_results">
          </div>
        </div>
        <div id="user_results">
        </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>