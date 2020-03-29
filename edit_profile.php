<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include_once("classes/User.class.php");

$user = new User();
/*$user->setUser_id($_SESSION["user_id"]);
$profile = $user->getUserInfo();*/

// test data 
$user->setUser_id(7);
$profile = $user->getUserInfo();

// UPLOAD PICTURE
if (!empty($_POST["uploadImg"])) {
    if (!empty($_FILES['profileImg']['name'])) {

        //get size of file
        $imgSize = $_FILES['profileImg']['size'];

        //check if file is nog too big
        if ($imgSize < 100000) {

            //save name & temp
            $nameWithoutSpace = preg_replace('/\s+/', '', $_FILES['profileImg']['name']);
            $nameWithoutSpaceTMP = preg_replace('/\s+/', '', $_FILES['profileImg']['tmp_name']);

            // check expensions
            $expensions = array("jpeg", "jpg", "png", "gif");
            $tmp = explode('.', $nameWithoutSpace);
            $imgExtension = end($tmp);

            if (in_array(strtolower($imgExtension), $expensions) === true) {

                // save
                $user->setImageSize($imgSize);
                $user->setImageTmpName($nameWithoutSpaceTMP);
                $user->setImageName($nameWithoutSpace);

                //check if profile img was set - set up querry
                if (isset($profile[1]['image_name'])) {
                    $insert_img = 'UPDATE profile_image SET image_name = :imgName, image_size = :imgSize, image_temp_name = :imgTmp WHERE user_id = :userId ';
                } else {
                    $insert_img = "INSERT INTO profile_image VALUES('', :imgName, :imgSize, :imgTmp, :userId)";
                };
                //add to db
                $user->SaveProfileImg($insert_img);
            } else {
                $imgError = "Onjuiste format. Verwacht: jpeg, jpg, png, gif. <br> Gekregen " .  $imgExtension;
            };
        } else {
            $imgError = "Bestand is te groot.";
        };
    } else {
        $imgError = "Voeg afbeelding toe";
    };
}; // end upload image

//update firstname lastname
if (!empty($_POST["edit"])) {
    
    //if given update firstname
    if (!empty($_POST["firstname"])) {
        $user->setFirstname($_POST["firstname"]);
        $user->saveFirstname();
    
    };

    //if given update lastname
    if (!empty($_POST["lastname"])) {
        $lastname = $_POST["lastname"];
        $user->setLastname($lastname);
        $user->saveLastname();
       
    };

    //if given update email
    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
        //check if email is valid
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            //check if email was used
        if ($user->emailExists($email) == false) {
            $user->setEmail($email);
            $user->saveEmail();
        } else {
            $emailError = "Voeg een nieuwe email toe";
        }
    } else {
        $emailError = $email + "Het is geen geldig email adress";
    }
   
    };
} // end $_POST["edit"]; 

if(!empty($_POST["passwordedit"]) ){
    //validate current password
    $oldPassword = $_POST['oldPassword'];
    if($user->passwordExists($oldPassword)){
        
        $password = $_POST['password'];
        // check if passwords are the same
        if($_POST['password'] == $_POST['repassword']){
            //check if password is long enough
            if(strlen($password) > 7){
                $user->setPassword($password);
            
                $user->savePassword();
                echo "nieuwe wachtwoord!";
            } else {
                $error = "wachtwoord moet 8 tekens bewaten";
            }
        }else {
            $error = "wachtwoords moeten overeen komen";
        }

    } else {
        $error = "wrong password";
    };
    
}

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
                <p>Dat wachtwoord was onjuist. Probeer het opnieuw! <?php echo $error; ?></p>
            </div>
        <?php endif; ?>

        <!-- profielfoto -->
        <img src="<?php echo "data/profile/" . $profile[1]['image_name'] ?>" alt="Profielfoto">
        <input type="file" name="profileImg" id="profileImg" class="new_avatar" accept="image/gif, image/jpeg, image/png, image/jpg">
        <!-- indien bestaand te groot is = error  -->
        <?php if (isset($imgError)) : ?>
            <div class="form_error">
                <p><?php echo $imgError; ?></p>
            </div>
        <?php endif; ?>
        <!-- indien alles goed verliep  -->
        <?php if (isset($imgSucces)) : ?>
            <div class="form_success">
                <p><?php echo $imgSuccess; ?></p>
            </div>
        <?php endif; ?>
        <!--button-->
        <input type="submit" name="uploadImg" class="btn" value="Upload Image">

        <!-- gegevens gebruiker -->
        <h2>Change Profile</h2>
        <input type="text" id="firstname" name="firstname" placeholder="Voornaam">
        <input type="text" id="lastname" name="lastname" value="" placeholder="Achternaam">
        <?php if (isset($emailError)) : ?>
            <div class="form_success">
                <p><?php echo $imgError; ?></p>
            </div>
        <?php endif; ?>
        <input type="email" id="email" name="email" value="" placeholder="E-mailadres of gebruikersnaam">
        <!-- button -->
        <input type="submit" name="edit" class="btn" value="Bewerk profiel">

        <!-- wachtwoord aanpassen -->
        <h2>Change Password</h2>
        <br>
            <h4>Old password</h4>
            <input type="password" id="oldPassword" name="oldPassword" placeholder="Oude password">
            <h4>New password</h4>
        <input type="password" id="password" name="password" placeholder="Nieuw wachtwoord">
        <input type="password" name="repassword" id="repassword" placeholder="Bevestig nieuw wachtwoord">

        <input type="submit" name="passwordedit" class="btn" value="Bewerk wachtwoord">
    </form>

</body>

</html>