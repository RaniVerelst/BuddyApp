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
$connections = $user->getFriendList();
$friendList = cleanArray($connections, $activeUser);

var_dump($friendList);


// remove user
function cleanArray($arr, $user){
    $newArr = [];
    foreach($arr as $friend){
          if($friend != $user){
                array_push($newArr, $friend);
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