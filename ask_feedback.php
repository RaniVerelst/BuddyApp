<!-- Werkt op index pagina wanneer gebruiker geregistreerd is 
 BEVAT:
* feature 22 ask feedback on project
-->
<?php
include_once("classes/Db.class.php");
include_once("classes/Feedback.class.php");
// FEATURE 22

//detect click
if (isset($_POST['requestFeedback'])) {

    $feedback = new Feedback();

    $feedback->setCurrentUser($currentUser);
    //get needed skills 
    if (isset($_POST['skills'])) {
        $project = checkSkills($_POST['skills']);
        $feedback->setTopic($project);
    } else {
        $errorSkills = "Please choose category!";
        $errorFeedback = true;
    }

    //get link to project
    if (checkLink() == true) {
        $feedback->setLink($_POST['projectLink']);
    } else {
        $errorLink = "Unvalid link. Tip: link should start with https://";
        $errorFeedback = true;
    }

    //find 3 users who can give feedback on project
    $feedbackers = $feedback->findFeedbacker();
    var_dump($feedbackers[0][0]);

    $feedback->setUser1($feedbackers[0][0]);
    $feedback->setUser2($feedbackers[1][0]);
    $feedback->setUser3($feedbackers[2][0]);
    
    //when no errors execute
    if (!isset($errorFeedback)) {
        $feedback->setDate(getTime());
        $feedback->requestFeedback();
    }
}

function checkLink()
{
    $string = $_POST['projectLink'];
    if (substr($string, 0, 8) === "https://") {
        return true;
    } else {
        return false;
    }
}

function checkSkills($skills)
{
    if ($skills == "design") {
        return "design";
    } else if ($skills == "development") {
        return  "development";
    }
}

function getTime()
{
    date_default_timezone_set('Europe/Brussels');
    date_default_timezone_get();

    $timeLine = date("Y-m-d H:i:s");

    return $timeLine;
}


?>
<div>
    <!-- feature 22 ask feedback -->
    <form name="buddy_suggestion" class="form_signup" method="post" action="">
        <h2>Project feedback</h2>
        <h4>I need some help in: </h4>
        <div class="form-check ">
            <label class="form-check-label" for="design"> DESIGN </label>
            <input class="form-check-input" type="radio" name="skills" value="design" id="design">
        </div>
        <div class="form-check">
            <label class="form-check-label" for="dev"> DEVELOPMENT </label>
            <input class="form-check-input" type="radio" name="skills" value="development" id="development">
        </div>
        <h4>Link to design or github repository</h4>
        <input type="text" id="projectLink" name="projectLink" placeholder="Place here link to your design or code">
        <input class="submit_signup" type="submit" name="requestFeedback" value="Ask for feedback">
    </form>
</div>

<?php if (isset($beginTalk)) {
    include_once('buddy_suggestion.php');
} ?>