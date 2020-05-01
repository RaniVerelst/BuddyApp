<!-- Werkt op index pagina wanneer gebruiker geregistreerd is 
 BEVAT:
* feature 22 toont dat gebruiker een aanvrag voor feedback heeft gekregen
-->
<?php 
//check if there any feedbacks send
include_once("classes/Db.class.php");
include_once("classes/Feedback.class.php");

$notificationFeedback = new Feedback();

$notificationFeedback->setCurrentUser($currentuser);
?>
<div>
<h2>Notifications:</h2> 
<ul>
    <li>
        <p>User 1 asks for feedback </p>
        <a href="http://" alt="link to project">Link to project</a>
        <a href="">Give feedback</a>
        <a href="">Ignore</a>
    </li>
</ul>


</div>