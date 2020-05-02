<?php 
// create chat 1v1
require_once('classes/ChatPrivate.class.php');

function createConversation($cU, $b, $t){
    $newBuddyChat = new ChatPrivate();

    $newBuddyChat->setUser1($cU);
    $newBuddyChat->setUser2($b);
    $newBuddyChat->setTopic($t);
    $newBuddyChat->setDate(getTime());

    $newBuddyChat->requestChat();
}
// function needed to createConversation & ask_feedback
function getTime()
{
    date_default_timezone_set('Europe/Brussels');
    date_default_timezone_get();

    $timeLine = date("Y-m-d H:i:s");

    return $timeLine;
}
?>