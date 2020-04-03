<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("classes/Db.class.php");
include_once("classes/User.class.php");

if(isset($_GET['search'])){
  $searchkey = $_GET['search'];
  $search_users = new User();
  $result_users = $search_users->searchUser($searchkey);

  $conn = Db::getInstance();
  $statement = $conn->prepare("select * from users");
  $statement->execute();
  $users = $statement->fetchAll();
/*
  $u = new User();
  $users = $u->showUser($id);
*/
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
      <?php if(count($result_users) > 0 ): ?>
        <h1> <?php echo count($result_users) . " Search Result(s) found for " . "<span style = 'font-weight: bold'> &quot" . $searchkey . "&quot </span>"; ?></h1>
    <?php else: ?>
      <h1>No results found </h1>
      <?php endif; ?>
      <nav>
      <br>
     <p><span style="font-weight: bold">Username:</span> <?php echo $users['user_name']; ?></p>
     <p><span style="font-weight: bold">Full name:</span> <?php echo $users['first_name'] . " " . $users['last_name']; ?></p>
     </nav>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>