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
$buddy1 = getBuddieInfo($matched[0]);
$buddy2 = getBuddieInfo($matched[1]);
$buddy3 = getBuddieInfo($matched[2]);
// get list of common interests
$buddy1Characteristics = getCommonInterest($buddy1, $movie, $destination, $cookie, $serie, $hangouts);
$buddy2Characteristics = getCommonInterest($buddy2, $movie, $destination, $cookie, $serie, $hangouts);
$buddy3Characteristics = getCommonInterest($buddy3, $movie, $destination, $cookie, $serie, $hangouts);


function getCommonInterest($buddy, $m, $d, $c, $s, $h){
    $arr =[];
    if($buddy[1]['movie'] == $m){
        array_push($arr, $m);
    };
    if($buddy[1]['destination'] == $d){
        array_push($arr, $d);
    };
    if($buddy[1]['cookie'] == $c){
        array_push($arr, $c);
    };
    if($buddy[1]['serie'] == $s){
        array_push($arr, $s);
    };
    if($buddy[1]['hangout'] == $h){
        array_push($arr, $h);
    };
    return $arr;
}

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
        <h2><?php echo $buddy1[0]['first_name'] . " " . $buddy1[0]['last_name'] ?></h2>
        <img src="<?php echo "data/profile/" . $buddy1[0]['image_name'] ?>" alt="">
        <p>Things you have in common: <?php 
        foreach($buddy1Characteristics as $characteristic){
            echo $characteristic . ' ';
        };
        ?> </p>
    </div>
    <div>
        <h2><?php echo $buddy2[0]['first_name'] . " " . $buddy2[0]['last_name'] ?></h2>
        <img src="<?php echo "data/profile/" . $buddy2[0]['image_name'] ?>" alt="">
        <p>Things you have in common:
        <?php 
        foreach($buddy2Characteristics as $characteristic){
            echo $characteristic . ' ';
        };
        ?> 
        </p>
    </div>
    <div>
        <h2><?php echo $buddy3[0]['first_name'] . " " . $buddy3[0]['last_name'] ?></h2>
        <img src="<?php  echo "data/profile/" . $buddy[3]['image_name'] ?>" alt="">
        <p>Things you have in common: 
        <?php 
        foreach($buddy3Characteristics as $characteristic){
            echo $characteristic . ' ';
        };
        ?> 
        </p>
    </div>
</div>