<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("classes/Userprofile.class.php");

$userId = 1;
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



$matchesArr = createOneArray($movie, $destination, $cookie, $serie, $hangouts);

$idFrequencies = vindUserIdFrequency($matchesArr);
$matched = findBestMatches($idFrequencies);

//get info about matches
function getBuddieInfo($buddyId){
    $user = new User();
    $user->setUserId($buddyId);
    $profile = $user->getUserInfo();
    $characteristics = new Userprofile();
    $characteristics->setUserId($buddyId);
    $profileChar = $characteristics->getAllCharacteristics();

    $arr = [$profile, $profileChar];
    return $arr;
}

//compare
function findBestMatches($arr)
{
    $buddyOne = "";
    $buddyTwo = "";
    $buddyThree = "";
    $buddyOneFrequency = 0;
    $buddyTwoFrequency = 0;

    foreach ($arr as $id => $v) {
        if ($arr[$id] > $buddyOneFrequency) {
            $buddyOneFrequency = $arr[$id];
            $buddyOne = array_search($buddyOneFrequency, $arr);
        } else if ($arr[$id] > $buddyTwoFrequency) {
            $buddyThree = $buddyTwo;
            $buddyTwoFrequency = $arr[$id];
            if ($buddyOneFrequency === $buddyTwoFrequency) {
                unset($arr[$buddyOne]);
            }
                $buddyTwo = array_search($buddyTwoFrequency, $arr);
        } 
    }; //end finding 3 best matches
    return [$buddyOne, $buddyTwo, $buddyThree];
};
//count how much characteristics other users have in common with active user 
function vindUserIdFrequency($arr)
{
    sort($arr);
    $newArr = array_count_values($arr);
    return $newArr;
}

//create one array
function createOneArray($m, $d, $c, $s, $h)
{
    $movieArr = createArr($m);
    $destinationArr = createArr($d);
    $cookieArr = createArr($c);
    $serieArr = createArr($s);
    $hangoutsArr = createArr($h);

    $arr = array_merge($movieArr, $destinationArr, $cookieArr, $serieArr, $hangoutsArr);
    return $arr;
}

//create array of users with the same characteristic
function createArr($value)
{
    $arrUsers = setUpArray($value);
    $arrUsersId = arrayOfUsers($arrUsers);
    $arrCleanedUsersId = cleanArray($arrUsersId);
    return $arrCleanedUsersId;
}

//get all users with the same characteristic as active user
function setUpArray($characteristic)
{
    $user = new User();
    $arr = $user->searchKenmerk($characteristic);
    return $arr;
}
//create array of users id
function arrayOfUsers($arr)
{
    $newArr = [];
    foreach ($arr as $value => $key) {
        array_push($newArr,  $arr[$value]['user_id']);
    }
    return $newArr;
}
// delete active user from array
function cleanArray($arr)
{
    /*$user = new User();
  $userid = $_SESSION["user_id"]);*/

    //test userId
    $userId = 1;
    for ($i = 0; $i < sizeof($arr); $i++) {
        if ($arr[$i] == $userId) {
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