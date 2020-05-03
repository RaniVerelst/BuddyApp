<?php 
// create chat 1v1
require_once('classes/ChatPrivate.class.php');

function createConversation($cU, $b, $t, $k, $a){
    $newBuddyChat = new ChatPrivate();

    $newBuddyChat->setUser1($cU);
    $newBuddyChat->setUser2($b);
    $newBuddyChat->setTopic($t);
    $newBuddyChat->setDate(getTime());
    $newBuddyChat->setUniqueKey($k);
    $newBuddyChat->setAccepted($a);

    $newBuddyChat->requestChat();
}

// create generated string so it i's easiet to find conversation
function createChatKey($user1id, $user2id){
    $idString = $user1id . "talk" . $user2id;
    $inputLength = strlen($idString);
    $randomStr = '';
    for($i = 0; $i < 20; $i++) {
        $randomChar = $idString[mt_rand(0, $inputLength - 1)];
        $randomStr .= $randomChar;
    }
 
    return $randomStr;
}
?>