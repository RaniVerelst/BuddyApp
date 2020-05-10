<?php
$db_host = 'raniveq332';
$db_user = '5o2zdnjh';
$db_pwd = '185.182.57.54';
$db_name = 'raniveq332_buds';



$conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);



if (isset($_POST['user_name'])) {
    $name = $_POST['user_name'];

    $query = ("SELECT * FROM users  WHERE `user_name`LIKE'$name'");
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    if ($rows > 0) {
        echo "User Name Already Exist";
    } else {
        echo "Available";
    }
    exit();
}
