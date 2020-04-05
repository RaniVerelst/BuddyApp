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
//var_dump($arrMovie);
echo '<br> time <br> <br>';
//delete current user from array
// Set array
function setUpArray($characteristic){
    $user = new User();
    $arr = $user->searchKenmerk($characteristic);
    return $arr;
}
function arrayOfUsers($arr){
    $newArr = [];
    foreach($arr as $value => $key){
    array_push($newArr,  $arr[$value]['user_id']);
    }
    return $newArr;
}

$arrTest = setUpArray($movie);
$show = arrayOfUsers($arrTest);
var_dump($show); 


function cleanArray($arr ,$userId){
    for($i =0; $i < sizeof($arr); $i++){
        if($arr[$i]['user_id'] == $userId ){
           unset($arr[$i]);
        }
    }
    return $arr;
};
//compare arrays

$cleanArrMovie = cleanArray($arrMovie, $userId);
//var_dump($cleanArrMovie);
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