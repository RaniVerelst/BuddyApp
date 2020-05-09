<?php
/*
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'php2020');
*/
define('DB_SERVER', '.182.57.51854');
define('DB_USER', 'raniveq332');
define('DB_PASSWORD', '5o2zdnjh');
define('DB_NAME', 'raniveq332_buds');

if (isset($_GET['term'])){
	$return_arr = array();

	try {
	    $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
		$stmt = $conn->prepare('SELECT * FROM room WHERE room_number LIKE :term
		union select * from room where campus like :term');
	    $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
	    
	    while($row = $stmt->fetch()) {
            $return_arr[] =  $row['room_number'];
            $return_arr[] =  $row['campus'];
	    }
	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}


    /* Toss back results as json encoded array. */
	echo json_encode($return_arr);
	
}


?>