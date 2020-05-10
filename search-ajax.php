<?php

define('DB_SERVER', '185.182.57.54');
define('DB_USER', 'raniveq332');
define('DB_PASSWORD', '5o2zdnjh');
define('DB_NAME', 'raniveq332_buds');




if (isset($_GET['term'])) {
	$return_arr = array();

	try {
		$conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare('SELECT * FROM profile_details WHERE destination LIKE :term
        union select * from profile_details where serie like :term
        union select * from profile_details where cookie like :term
        union select * from profile_details where movie like :term
        union select * from profile_details where hangout like :term
        ');
		$stmt->execute(array('term' => '%' . $_GET['term'] . '%'));

		while ($row = $stmt->fetch()) {
			$return_arr[] =  $row['destination'];
			$return_arr[] =  $row['serie'];
			$return_arr[] =  $row['cookie'];
			$return_arr[] =  $row['movie'];
			$return_arr[] =  $row['hangout'];
		}
	} catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}


	/* Toss back results as json encoded array. */
	echo json_encode($return_arr);
}
