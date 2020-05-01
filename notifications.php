<!-- Werkt op index pagina wanneer gebruiker geregistreerd is 
 BEVAT:
* feature 22 toont dat gebruiker een aanvrag voor feedback heeft gekregen
-->
<?php 
//check if there any feedbacks send
include_once("classes/Db.class.php");
include_once("classes/Feedback.class.php");
include_once("classes/User.class.php");

//get al feedbacks
$notificationFeedback = new Feedback();

$notificationFeedback->setCurrentUser($currentUser);

$allFeedbacksReguests = $notificationFeedback->getAllActiveFeedbacksRequests();

function findUserName($id){
    $user = new User();
    $user->setUserId($id);
    $userInfo = $user->getUserInfo();
    $userName = $userInfo['first_name'] . " " . $userInfo['last_name'];
    return $userName;
}

?>
<div>
<h2>Notifications:</h2>

<h4>Feedbacks requests:</h4>
<ul>
    <?php if(sizeOf($allFeedbacksReguests) > 0): 
        foreach($allFeedbacksReguests as $user):
       
        ?>
    <li>
        <p><?php echo $user[2] ?></p>
        <p><?php echo  findUserName($user[0]); ?> asks for feedback!! </p>
        <p>Project type: <?php echo $user[3]; ?></p>
        <a href="<?php echo $user[1];?>" alt="link to project">Link to project</a>
        <br>
        <a href="">Give feedback</a>
        <a href="">Ignore</a>
    </li>
        <?php endforeach;
endif; ?>
</ul>
</div>