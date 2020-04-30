<!-- Werkt op index pagina wenneer gebruiker geregistreerd is 
 BEVAT:
* feature 5
-->
<?php
include_once("classes/Db.class.php");
include_once("classes/BuddySuggestion.class.php");
// FEATURE 5 / 8




// set up buddy-suggestie

if(isset($_POST['buddySuggestion'])){

    $buddySuggestion = new BuddySuggestion();

    $skillsInNeed = $_POST['buddySuggestion'];

    if ($skillsInNeed == "design") {
        $buddySkills = "design";
        echo "clicked on design";
    } else if ($skillsInNeed == "development") {
        $buddySkills = "development";
    }

    //$buddySuggestion->setTopic($buddySkills);
    //save and open BuddySuggestion.class
    //$buddySuggestion->setUser1($currentUser);
    //$buddySuggestion->setDate(getTime());

    //$buddySuggestion->requestConversation();

    //header("buddy_suggestion.php");
}

function getTime(){
    $timeLine = time() . "-" . date("d-m-y");
    return $timeLine;
}

?>
<div>
    <!-- feature 5  find help -->
    <form name="buddy_suggestion" class="form_signup" method="post" action="">
        <h2>Buddy suggestion</h2>
        <h4>I need some help in: </h4>
        <div class="form-check ">
            <label class="form-check-label" for="design"> DESIGN </label>
            <input class="form-check-input" type="radio" name="skills" value="design" id="design">
        </div>
        <div class="form-check">
            <label class="form-check-label" for="dev"> DEVELOPMENT </label>
            <input class="form-check-input" type="radio" name="skills" value="development" id="development">
        </div>
        <input class="submit_signup" type="submit" name="buddySuggestion" value="Talk to buddy">
    </form>
</div>