<?php
// FREATURE 9
// Displays user's friend lists
// 
//
include_once("classes/Db.class.php");
include_once("classes/Friendlist.class.php");

$user = new Friendlist();
$user->setUserId(1);

$activeUser = $user->getUserId();

//get list of friends
$connections = $user->getFriendList();
$friendList = createFriendList($connections, $activeUser);

echo '<pre>';
var_dump($friendList);
echo '</pre>';
//

// remove user from connections
function createFriendList($arr, $activeUser){
    
    //check userid_1
    $column1 = cleanArray($arr, 'user1_id', $activeUser);
    $column2 = cleanArray($arr, 'user2_id', $activeUser);
    /*for($i = 0; $i < sizeof($arr); $i++){
        if($arr[$i]["user1_id"] != $user){
            array_push($newArr, $arr[$i]["user1_id"]);
        }
    }
    //check userid_2
    for($i = 0; $i < sizeof($arr); $i++){
        if($arr[$i]["user2_id"] != $user){
            array_push($newArr, $arr[$i]["user2_id"]);
        }
    }*/
    $newArr = array_merge($column1, $column2);
    return $newArr;
}

// loop
function cleanArray($arr, $column, $activeUser){
    
    $newArr = [];

    for($i = 0; $i < sizeof($arr); $i++){
        if($arr[$i][$column] !=  $activeUser){
            array_push($newArr, $arr[$i][$column]);
        }
    }
    return $newArr;
}


?>
<div>
<h1>Friend list</h1>
<div class="friend-container ">
<img src="" alt="user photo">
<h2>User name</h2>

</div>
</div>