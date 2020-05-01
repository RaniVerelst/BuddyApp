<!-- Werkt op index pagina wanneer gebruiker geregistreerd is 
 BEVAT:
* feature 22 ask feedback on project
-->
<?php include_once("header.php"); ?>

<div class="container">
    <?php include_once('match.php'); ?>
<?php include_once('notifications.php'); ?>
<?php include_once('ask_feedback.php'); ?>
<div>
    <?php include_once('buddy_suggestion_settings.php');?>
    <?php if($searchForBuddy == true){ include_once('buddy_suggestion.php'); }  ?>
</div>
</div>