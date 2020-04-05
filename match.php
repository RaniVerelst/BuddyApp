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
/*$arrMovie = $user->searchKenmerk($movie);
$arrDestination = $user->searchKenmerk($destination);
$arrCookie = $user->searchKenmerk($cookie);
$arrSerie = $user->searchKenmerk($serie);
$arrHangouts = $user->searchKenmerk($hangouts);    */

// Set array

$arrTest = setUpArray($movie);
$show = arrayOfUsers($arrTest);

$cleanerArr = cleanArray($show, $userId);
var_dump(createOneArray($movie, $destination, $cookie, $serie,$hangouts)); 
//compare users
function createOneArray($m, $d, $c, $s, $h){
$movieArr = createArr($m);
$destinationArr = createArr($d);
$cookieArr = createArr($c);
$serieArr = createArr($s);
$hangoutsArr = createArr($h);

$arr = array_merge($movieArr, $destinationArr, $cookieArr, $serieArr, $hangoutsArr);
return $arr;
}

//create array of users with the same characteristic
function createArr($value){
    $arrUsers = setUpArray($value);
    $arrUsersId = arrayOfUsers($arrUsers);
    $arrCleanedUsersId = cleanArray($arrUsersId);
    return $arrCleanedUsersId;
}

//get all users with the same characteristic as active user
function setUpArray($characteristic){
    $user = new User();
    $arr = $user->searchKenmerk($characteristic);
    return $arr;
}
//create array of users id
function arrayOfUsers($arr){
    $newArr = [];
    foreach($arr as $value => $key){
    array_push($newArr,  $arr[$value]['user_id']);
    }
    return $newArr;
}
// delete active user from array
function cleanArray($arr){
$user = new User();
// $userid = $_SESSION["user_id"]);*/
//test
$userId = 1;
    for($i =0; $i < sizeof($arr); $i++){
        if($arr[$i] == $userId ){
           unset($arr[$i]);
        }
    }
    return $arr;
};


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