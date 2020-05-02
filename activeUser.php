<!-- Werkt op index pagina wanneer gebruiker geregistreerd is 
 BEVAT:
* feature 22 ask feedback on project
-->
<?php 
include_once("chat_private_setup.php");
include_once("header.php"); ?>

<div class="container">
    <div class="header-activeuser">
    <?php include_once('match.php'); ?>
<?php include_once('notifications.php'); ?>
    </div>
    <div class="extra-feature">
<?php include_once('ask_feedback.php'); ?>
</div>
<div class="userProfile-activeUser">
    <!-- find buddy -->
    <?php include_once('buddy_suggestion_settings.php');?>
    <?php if($searchForBuddy == true){ include_once('buddy_suggestion.php'); } ?>
    </div>
    <div class="centerContent-activeUser">
   <!-- Display chat is needed -->
    <?php if(isset($beginPrivateChat)){
        if($beginPrivateChat == true){ include_once('chat_private.php'); }}?>
    </div>
</div>
</div>
</div>