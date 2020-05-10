<?php
// FEATURE 13
// Display registered users and connections
include_once("classes/Db.class.php");
include_once("classes/Friendlist.class.php");

if (!empty($_GET['search'])) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="startbootstrap/css/freelancer.min.css" type="text/css" rel="stylesheet">
    <link href="style/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,900&display=swap" rel="stylesheet">

    <title>Buddy App</title>
</head>

<body>
    <?php include_once("includes/header.php") ?>
    <div class="faq">
        <h1>LOKALEN</h1>

    </div>

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
        <?php if (is_countable($result_room) > 0) : ?>
            <h1> <?php echo count($result_room) . " Search Result(s) found for " . "<span style = 'font-weight: bold'> &quot" . $searchkey . "&quot </span>"; ?></h1>
        <?php else : ?>
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