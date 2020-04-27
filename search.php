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
  var_dump($users);
}

// _____________KENMERKEN _______________ //

if(isset($_GET['search'])){
  $searchkey = $_GET['search'];
  $search_kenmerken = new User();
  $result_kenmerken = $search_kenmerken->searchKenmerk($searchkey);

  $k = new User();
  $kenmerken = $k->showKenmerk($searchkey);
  var_dump($kenmerken);
}
/*
// ________________IN 1 ________________ //

if(isset($_GET['search'])){
  $searchkey = $_GET['search'];
  $search_all = new User();
  $result_all = $search_all->searchAll($searchkey);
  var_dump($result_all);

  $a = new User();
  $all = $a->showAll($searchkey);
  var_dump($all);
}
*/

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
     <p><span style="font-weight: bold">Username:</span> <?php echo $users['user_name']; ?></p>
     <p><span style="font-weight: bold">Full name:</span> <?php echo $users['first_name'] . " " . $users['last_name']; ?></p>
    <br>
     <p><span style="font-weight: bold">Movie:</span> <?php echo $kenmerken['movie']; ?></p>
     <p><span style="font-weight: bold">Destination:</span> <?php echo $kenmerken['destination']; ?></p>
     <p><span style="font-weight: bold">Cookie:</span> <?php echo $kenmerken['cookie']; ?></p>
     <p><span style="font-weight: bold">Serie:</span> <?php echo $kenmerken['serie']; ?></p>
     <p><span style="font-weight: bold">Hangout:</span> <?php echo $kenmerken['hangout']; ?></p>
     </nav>
</div>

<!--
    <div class="search_results">
    <?php if(count($result_all) > 0 ): ?>
        <h1> <?php echo count($result_all) . " Search Result(s) found for " . "<span style = 'font-weight: bold'> &quot" . $searchkey . "&quot </span>"; ?></h1>
    <?php else: ?>
      <h1>No results found </h1>
      <?php endif; ?>
      <nav>
      <br>
     <p><span style="font-weight: bold">Username:</span> <?php echo $all['user_name']; ?></p>
     <p><span style="font-weight: bold">Full name:</span> <?php echo $all['first_name'] . " " . $all['last_name']; ?></p>
    <br>
     <p><span style="font-weight: bold">Movie:</span> <?php echo $all['movie']; ?></p>
     <p><span style="font-weight: bold">Destination:</span> <?php echo $all['destination']; ?></p>
     <p><span style="font-weight: bold">Cookie:</span> <?php echo $all['cookie']; ?></p>
     <p><span style="font-weight: bold">Serie:</span> <?php echo $all['serie']; ?></p>
     <p><span style="font-weight: bold">Hangout:</span> <?php echo $all['hangout']; ?></p>
     </nav>
</div>
-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>