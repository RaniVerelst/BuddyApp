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
    $chatUser2 = $newBuddy[0];
    $chatTopic = "buddyTalk";
    $keyChat = createChatKey($currentUser, $chatUser2);
    $accepted = 0;
//set up conversation
 createConversation($currentUser, $chatUser2, $chatTopic, $keyChat, $accepted);

 //get common characteristics to display - from match.php
 $buddyChat = getBuddieInfo($chatUser2);
 $buddyChatCharacteristics = getCommonInterest($buddyChat, $movie, $destination, $cookie, $serie, $hangouts);

}

?>


