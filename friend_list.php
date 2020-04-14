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
$friendList = cleanArray($connections, $activeUser);

echo '<pre>';
var_dump($connections);
echo '</pre><hr>';
echo '<pre>';
var_dump($friendList);
echo '</pre>';
//

// remove user from connections
function cleanArray($arr, $user){
    $newArr = [];
    //check userid_1
    for($i = 0; $i < sizeof($arr); $i++){
        if($arr[$i]["user1_id"] != 1){
            array_push($newArr, $arr[$i]["user1_id"]);
        }
    }
    //check userid_2
    for($i = 0; $i < sizeof($arr); $i++){
        if($arr[$i]["user2_id"] != 1){
            array_push($newArr, $arr[$i]["user2_id"]);
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