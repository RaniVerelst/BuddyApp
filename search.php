<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("classes/Db.class.php");
include_once("classes/User.class.php");

// _____________Naam_______________ //

if(isset($_GET['search'])){
  $searchkey = $_GET['search'];
  $search_users = new User();
  $result_users = $search_users->searchUser($searchkey);

  $u = new User();
  $users = $u->showUser($searchkey);  
}

// _____________KENMERKEN _______________ //

if(isset($_GET['search'])){
  $searchkey = $_GET['search'];
  $search_kenmerken = new User();
  $result_kenmerken = $search_kenmerken->searchKenmerk($searchkey);

  $k = new User();
  $kenmerken = $k->showKenmerk($searchkey);
}

?><!DOCTYPE html>
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
      <?php if(count($result_users) || ($result_kenmerken)  > 0 ): ?>
        <h1> <?php echo count($result_users) + count($result_kenmerken) . " Search Result(s) found for " . "<span style = 'font-weight: bold'> &quot" . $searchkey . "&quot </span>"; ?></h1>
    <?php else: ?>
      <h1>No results found </h1>
      <?php endif; ?>
      <nav>
      <br>
     <p><span style="font-weight: bold">Username:</span> <?php echo $users['user_name'] . $kenmerken['user_name']; ?></p>
     <p><span style="font-weight: bold">Full name:</span> <?php echo $users['first_name'] . $kenmerken['first_name'] . " " . $users['last_name'] . $kenmerken['last_name']; ?></p>
    <br>
     <p><span style="font-weight: bold">Movie:</span> <?php echo $kenmerken['movie'] . $users['movie']; ?></p>
     <p><span style="font-weight: bold">Destination:</span> <?php echo $kenmerken['destination']. $users['destination']; ?></p>
     <p><span style="font-weight: bold">Cookie:</span> <?php echo $kenmerken['cookie']. $users['cookie']; ?></p>
     <p><span style="font-weight: bold">Serie:</span> <?php echo $kenmerken['serie']. $users['serie']; ?></p>
     <p><span style="font-weight: bold">Hangout:</span> <?php echo $kenmerken['hangout']. $users['hangout']; ?></p>
     </nav>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>