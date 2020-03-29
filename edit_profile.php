<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include_once("classes/User.class.php");

$user = new User();
/*$user->setUser_id($_SESSION["user_id"]);
$profile = $user->getUserInfo();*/

// test data 
$user->setUser_id(6);
$profile = $user->getUserInfo();


// UPLOAD PICTURE
if (!empty($_POST["uploadImg"])) {
    if (!empty($_FILES['profileImg']['name'])) {
        //get size of file
        $imgSize = $_FILES['profileImg']['size'];
        if($imgSize < 100000 ){
            //connect balues to User.class
            $nameWithoutSpace = preg_replace('/\s+/','',$_FILES['profileImg']['name']);
            $nameWithoutSpaceTMP = preg_replace('/\s+/','',$_FILES['profileImg']['tmp_name']);
            
            $user->setImageSize($imgSize);
            $user->setImageTmpName($nameWithoutSpaceTMP);
            $user->setImageName($nameWithoutSpace);

            //check if profile img was set
            if(isset($profile[1]['image_name'])){
                //set up query
                $insert_img = 'UPDATE profile_image SET image_name = :imgName, image_size = :imgSize, image_temp_name = :imgTmp WHERE user_id = :userId ';
            } else {
                $insert_img= "INSERT INTO profile_image VALUES('', :imgName, :imgSize, :imgTmp, :userId)";
            } 
            $user->SaveProfileImg($insert_img);
        } else {
            $imgError = "Bestand is te groot.";
        };
        $imgSucces = "Geniet van je nieuwe profile photo";
        //echo $imgSize;
    } else {
        $imgError = "Voeg afbeelding toe";
        $img = "";
    };
}; // end upload image

//if(!empty($_POST["edit"])) {

// profiel aanpassen van user
/*  $user_edit = new User();
   // $user_edit->setUser_id($_SESSION["user_id"]);
   //Test version
   $user_edit->setUser_id(6);
   // $user_edit->setFirstname($_POST["firstname"]);
   // $user_edit->setLastname($_POST["lastname"]);
    
    if($profile['email'] == $_POST["email"]){
        $user_edit->setEmail($_POST["email"]);
    } elseif($user_edit->emailExists($_POST["email"])) {
        $user_edit->setEmail($profile["email"]); //Indien het profiel bestaat
        $error = "Emailadres bestaat al";
    } else {
        $user_edit->setEmail($_POST["email"]);
    }
/*    $user_edit->setBio($_POST["bio"]);
    $user_edit->setImage($destination);
    if($user_edit->update()){
        $message = "Your profile is updated.";
    } else {
        $error = "Something went wrong, profile isn't updated.";
    }  
} */


/*if(!empty($_POST["passwordedit"]) && !empty($_POST["password"]) && !empty($_POST["repassword"])){
    if(strcmp($_POST['password'], $_POST["repassword"]) == 0){
        $user_pass = new User();
        $user_pass->setUser_id($_SESSION["user_id"]);
         $user_pass->setPassword($_POST['password']);
  /*      if($user_pass->updatePassword()){
            $message = "Password updated";
        }
    } else {
        $error = "wachtwoorden moeten overeen komen";
    }
} else {
    $error = "Gelieve dit in te vullen aub"; */
//} 
//}
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/reset.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="startbootstrap/css/freelancer.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Edit Profile</title>
</head>

<body>

<form method="post" action="" class="edit_profile" enctype="multipart/form-data">   
        <h1>Profiel bewerken</h1>

        <!-- indien inloggegevens fout zijn = error -->
        <?php if (isset($error)) : ?>
            <div class="form__error">
                <p>Dat wachtwoord was onjuist. Probeer het opnieuw!</p>
            </div>
        <?php endif; ?>

        <!-- profielfoto -->
        <img src="<?php echo "data/profile/" . $profile[1]['image_name'] ?>" alt="Profielfoto">
        <input type="file" name="profileImg" id="profileImg" class="new_avatar" accept="image/gif, image/jpeg, image/png, image/jpg">
        <!-- indien bestaand te groot is = error  -->
        <?php if(isset($imgError)): ?>
        <div class="form_error">
        <p><?php echo $imgError;?></p>
        </div>
        <?php endif; ?>
        <!--button-->
        <input type="submit" name="uploadImg" class="btn" value="Upload Image">

        <!-- gegevens gebruiker -->
        <h2>Change Profile</h2>
        <input type="text" id="firstname" name="firstname" placeholder="Voornaam">
        <input type="text" id="lastname" name="lastname" value="" placeholder="Achternaam">
        <input type="email" id="email" name="email" value="" placeholder="E-mailadres of gebruikersnaam">
        <!-- button -->
        <input type="submit" name="edit" class="btn" value="Bewerk profiel">

        <!-- wachtwoord aanpassen -->
        <h2>Change Password</h2>

        <input type="password" id="password" name="password" placeholder="Nieuw wachtwoord">
        <input type="password" name="repassword" id="repassword" placeholder="Bevestig nieuw wachtwoord">

        <input type="submit" name="passwordedit" class="btn" value="Bewerk wachtwoord">
    </form>

</body>

</html>