<?php
//require_once('classes/ChatPrivate.class.php');

//don't start chat yet
$beginPrivateChat = false;

//find match
$mentor = new BuddySuggestion();

//get characteristics of current user for beter match
$mentor->setUserid($currentUser);
$currentUserCharacteristics = $mentor->getAllCharacteristics();

//set up characteristics for beter match
$mentor->setMovie($currentUserCharacteristics['movie']);
$mentor->setDestination($currentUserCharacteristics['destination']);
$mentor->setSerie($currentUserCharacteristics['serie']);
$mentor->setCookie($currentUserCharacteristics['cookie']);
$mentor->setHangout($currentUserCharacteristics['hangout']);

$newBuddy = $mentor->findBuddyMentor();

//if success set up conversation
if(sizeof($newBuddy) > 0){
    $beginPrivateChat = true;
    $chatUser2 = $newBuddy[0];
    $chatTopic = "buddyTalk";
//set up conversation
 createConversation($currentUser, $chatUser2, $chatTopic);
 
}

/*function createConversation($cU, $b, $t){

    $newBuddyChat = new ChatPrivate();

    $newBuddyChat->setUser1($cU);
    $newBuddyChat->setUser2($b);
    $newBuddyChat->setTopic($t);
    $newBuddyChat->setDate(getTime());

    $newBuddyChat->requestChat();
}*/
?>


