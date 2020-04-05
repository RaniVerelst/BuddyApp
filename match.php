<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("classes/Userprofile.class.php");

$userId= 1;
// $userid = $_SESSION["user_id"]);*/

$user = new User();
$characteristics = new Userprofile();

// test
$user->setUserId($userId);
$profile = $user->getUserInfo();

$characteristics->setUserId($userId);



?>
<div>
<div class="">
<img src="" alt="">
<p>Things you have in common:</p>
</div>
<div>
<img src="" alt="">
<p>Things you have in common:</p>
</div>
<div>
<img src="" alt="">
<p>Things you have in common:</p>
</div>
</div>