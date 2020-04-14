<?php
// FREATURE 9
// Displays user's friend lists
// 
//
include_once("classes/Db.class.php");
include_once("classes/Friendlist.class.php");
//for user photo
include_once("classes/EditProfile.class.php");

$user = new Friendlist();
$user->setUserId(1);

$activeUser = $user->getUserId();

//------------- get list of friends id's
$connections = $user->getFriendList();
$friendList = createFriendList($connections, $activeUser);

// create list of user friends ids
function createFriendList($arr, $activeUser){

    $column1 = cleanArray($arr, 'user1_id', $activeUser);
    $column2 = cleanArray($arr, 'user2_id', $activeUser);

    $newArr = array_merge($column1, $column2);
    return $newArr;
}

// remove user from connections
function cleanArray($arr, $column, $activeUser){
    $newArr = [];

    for($i = 0; $i < sizeof($arr); $i++){
        if($arr[$i][$column] !=  $activeUser){
            array_push($newArr, $arr[$i][$column]);
        }
    }
    return $newArr;
}

//----------- get informations about friends

?>
<div>
<h1>Friend list</h1>
<?php foreach($friendList as $friendId):?>
<?php
    // get info about friend
    $friend = new EditProfile();
    $friend->setUserId($friendId);
    $friendsProfile = $friend->getUserInfo();
    ?>
<div class="friend-container ">
<img src="<?php echo "data/profile/" . $friendsProfile[0]['id'] ."-". $friendsProfile[1]['image_name']; ?>" alt="user photo">
<h2><?php echo $friendsProfile[0]['first_name'] . " " . $friendsProfile[0]['last_name']; ?></h2>
</div>
<?php endforeach; ?>
</div>