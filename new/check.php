<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pwd = '';
$db_name = 'php2020';

$conn = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);



if (isset($_POST['user_name'])) {
    $name = $_POST['user_name'];

    $query = ("SELECT * FROM users  WHERE `user_name`LIKE'$name'");
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    var_dump($name);
    if ($rows > 0) {
        echo "User Name Already Exist";
    } else {
        echo "Available";
    }
    exit();
}
