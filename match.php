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
$profileChar = $characteristics->getAllCharacteristics();

// get characteristics from active user
$movie = $profileChar['movie'];
$destination = $profileChar['destination'];
$cookie = $profileChar['cookie'];
$serie = $profileChar['serie'];
$hangouts = $profileChar['hangout'];

//get other users based on characteristics
$arrMovie = $user->searchKenmerk($movie);
$arrDestination = $user->searchKenmerk($destination);
$arrCookie = $user->searchKenmerk($cookie);
$arrSerie = $user->searchKenmerk($serie);
$arrHangouts = $user->searchKenmerk($hangouts);    
var_dump($arrMovie);
echo '<br> time <br> <br>';
//delete current user
for($i =0; $i < sizeof($arrMovie); $i++){
    if($arrMovie[$i]['user_id'] == $userId ){
        unset($arrMovie[$i]);
    }
}

var_dump($arrMovie);

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