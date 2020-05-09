<?php
ini_set('display_startup_errors', 1);
error_reporting(-1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("header.php");

// _____________Room_______________ //

if(!empty($_GET['search'])){
  $searchkey = $_GET['search'];
  $search_room = new User();
  $result_room = $search_room->searchRoom($searchkey);
  
    $r = new User();
    $room = $r->showRoom($searchkey); 
} else {
     $room = null;
     $result_room = null;
     $searchkey = null;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
    <title>Local</title>
</head>

<body>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>	
    <script type="text/javascript">
      $(function() {
        
        //autocomplete
        $("#auto").autocomplete({
          source: "room-ajax.php",
          minLength: 1
        });				

      });
    </script>
  <section class="searchline">
    <div>
        <h1>Find a room</h1>
    </div>
        <form class="search" method="get" action="">
            <input class="input_search3" type="text" name="search" id="auto" placeholder="Search on room-number, floor, capacity or campus" value="">
            <input class="btn_search" type="submit" value="">
        </form>
    </section>
    <div class="search_results">
      <?php if(count($result_room) > 0 ): ?>
        <h1> <?php echo count($result_room) . " Search Result(s) found for " . "<span style = 'font-weight: bold'> &quot" . $searchkey . "&quot </span>"; ?></h1>
    <?php else: ?>
      <h1>No results found </h1>
      <?php endif; ?>
      <nav>
      <br>
     <p><span style="font-weight: bold">Room-name/number :</span> <?php echo $room['room_number']; ?></p>
     <p><span style="font-weight: bold">Floor:</span> <?php echo $room['floor']; ?></p>
     <p><span style="font-weight: bold">Capacity:</span> <?php echo $room['capacity']; ?></p>
     <p><span style="font-weight: bold">Campus:</span> <?php echo $room['campus']; ?></p>
     </nav>
</div>

</body>
</html>