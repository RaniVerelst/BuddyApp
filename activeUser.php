<!-- Werkt op index pagina wenneer gebruiker geregistreerd is 
 BEVAT:
* feature 5
-->
<?php
include_once("classes/Db.class.php");
include_once("classes/BuddySuggestion.class.php");
// FEATURE 5 / 8

echo time();
if(isset($_POST['buddySuggestion'])){

// set up buddy-suggestie
if(isset($_POST['skills'])){

    $buddySuggestion = new BuddySuggestion();

    $buddySkills = checkSkills($_POST['skills']);

    $buddySuggestion->setTopic($buddySkills);
    $buddySuggestion->setUser1($currentUser);
    $buddySuggestion->setDate(getTime());

    $buddySuggestion->requestConversation();
    $beginTalk = true;
}

}
function checkSkills($skills){
    if ($skills == "design") {
       return "design";
    } else if ($skills == "development") {
      return  "development";
    }
}
function getTime(){
    date_default_timezone_set('Europe/Brussels');
    date_default_timezone_get();

    $timeLine = date("Y-m-d H:i:s"); 
    
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

<?php if(isset($beginTalk)){ include_once('buddy_suggestion.php'); } ?>