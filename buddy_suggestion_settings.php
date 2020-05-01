<!-- Werkt op index pagina wanneer gebruiker geregistreerd is
 BEVAT:
* feature 5 - keuze makken of je wil iem hulp als buddie aanbieden of zoek je naar buddy
-->
<?php
require_once('classes/BuddySuggestion.class.php');

$buddySuggestion = new BuddySuggestion();

$buddySuggestion->setCurrentUser($currentUser);
$buddySuggestion->setUserid($currentUser);

$searchForBuddy = false;

$currentUserCharacteristics = $buddySuggestion->getAllCharacteristics();

// check if user is from 2/3 year
$currentUserClass = $currentUserCharacteristics['class'];

//check if buddy mentor state saved
if (isset($_POST['buddy_mentor'])) {
    //check checkbox
    if (isset($_POST['buddyMentor'])) {

        $buddyMasterState = $_POST['buddyMentor'];

        $buddyState = checkBuddyMaster($buddyMasterState);

        $buddySuggestion->setBuddyMentorMode($buddyState);
        $buddySuggestion->becomeBuddyMentor();
    } else {
        $error = "";
    }
}

function checkBuddyMaster($b){
    if ($b == 'yes') {
        return 1;
    } else if ($b == 'no') {
        return 0;
    } 
}

if(isset($_POST['findBuddy'])){
$searchForBuddy = true;
echo 'lolc';
}
?>
<div>
    <h2>Buddy settings:</h2>
    <?php if ($currentUserClass == 'imd2' || $currentUserClass == 'imd3') : ?>
        <div>
            <form name="buddy_mentor" class="form_signup" method="post" action="">
                <h6>Do you want to be a buddy mentor?</h6>
                <div class="form-check ">
                    <label class="form-check-label" for="yes"> YES </label>
                    <input class="form-check-input" type="radio" name="buddyMentor" value="yes" id="buddyMentorNo">
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="dev"> NO </label>
                    <input class="form-check-input" type="radio" name="buddyMentor" value="no" id="yes">
                </div>
                <input type="submit" name="buddy_mentor" value="Save">
        </div>
        </form>
    <?php endif; ?>
    <div>
        <form name="find_buddy" class="form_signup" method="post" action="">
            <h6>Look for buddies:</h6>
            <input type="submit" name="findBuddy" value="Vind buddy!">
        </form>
    </div>

</div>