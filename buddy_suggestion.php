<?php

//find potentiele match
$mentor = new BuddySuggestion();

//characteristics of current user for beter match
$mentor->setUserid($currentUser);
$currentUserCharacteristics = $mentor->getAllCharacteristics();

//set up characteristics to beter compare
$mentor->setMovie($currentUserCharacteristics['movie']);
$mentor->setDestination($currentUserCharacteristics['destination']);
$mentor->setSerie($currentUserCharacteristics['serie']);
$mentor->setCookie($currentUserCharacteristics['cookie']);
$mentor->setHangout($currentUserCharacteristics['hangout']);
$mentor->setSkills($buddySkills); 


// start conversation
?>
<div>
<img src="" alt="profil photo">
<h2>Naam</h2>
<p>Matching text</p>
</div>
<!-- Begin gesrpek -->

<div></div>
