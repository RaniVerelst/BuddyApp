<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once("classes/Db.class.php");
//include_once("classes/User.class.php");
include_once("classes/EditProfile.class.php");
include_once("header.php");


//$user = new User();
$user = new EditProfile();

if( isset( $_SESSION["user_id"])){
    $user->setuserId($_SESSION["user_id"]);
  } else {
    echo 'user not found';
  }
// test data 

$profile = $user->getUserInfo();


  // ---------------UPLOAD PICTURE------------
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
                //give feedback
                $imgSuccess = "File successful uploaded!";
            } else {
                $imgError = "Wrong format. Expected: jpeg, jpg, png, gif. <br> Got: " .  $imgExtension;
            };
        } else {
            $imgError = "File is too big.";
        };
    } else {
        $imgError = "Add a picture";
    };
}; // end upload image


  // ---------------UPLOAD FIRSTNAME/LASTNAME/EMAIL------------
if (!empty($_POST["edit"])) {

    //if given update firstname
    if (!empty($_POST["firstname"])) {
        $user->setFirstname($_POST["firstname"]);
        $user->saveFirstname();
        $firstnameSucces = "firstname changed";
    };

    //if given update lastname
    if (!empty($_POST["lastname"])) {
        $user->setLastname( $_POST["lastname"]);
        $user->saveLastname();
        $lastnameSucces = "lastname changed";
    };

    //if given update email
    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
        //check if email is valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            //check if email was used
            if ($user->emailExists($email) == false) {
                $user->setEmail($email);
                $user->saveEmail();
                $emailSucces = "email changed";
            } else {
                $emailError = "Add your email";
            }
        } else {
            $emailError = $email + "This email isn't valid.";
        }
    };
    // create Successfull message
        if(isset($firstnameSucces)) { $messageArr[0] =  $firstnameSucces; } 
        if(isset($lastnameSucces)){ $messageArr[1] = $lastnameSucces; }
        if(isset($emailSucces)){ $messageArr[2] = $emailSucces; }
} // end $_POST["edit"]; 


  // ---------------ADD/CHANGE BIO------------
if(!empty($_POST["addBio"])){
    $text = htmlspecialchars($_POST['bioText']);
    if(strlen($text) < 255){
        $user->setBio($text);
        $user->saveBio();
    } else {
        $bioError = "Bio can contain up to 255 characters"; 
        echo $bioError;
    }

}


  // ---------------CHANGE PASSWORD------------
if (!empty($_POST["passwordedit"])) {
    //validate current password
    $oldPassword = $_POST['oldPassword'];
    if ($user->passwordExists($oldPassword)) {

        $password = $_POST['password'];
        // check if passwords are the same
        if ($_POST['password'] == $_POST['repassword']) {
            //check if password is long enough
            if (strlen($password) > 7) {
                $user->setPassword($password);
                echo "New password!";
            } else {
                $passwordError = "Password needs at least 8 characters.";
            }
        } else {
            $passwordError = "Passwords don't match.";
        }
    } else {
        $passwordError = "Wrong password!";
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
    <form action="" method="post">

    </form>
   

    <form method="post" action="" class="edit_profile" enctype="multipart/form-data">
        <h1>Change Profile</h1>
        <!-- ERROR = inloggegevens fout! -->
        <?php if (isset($error)) : ?>
            <div class="form__error">
                <p>That password wasn't right. Try Again! <?php echo $error; ?></p>
            </div>
        <?php endif; ?>
        <!-- profielfoto -->
        <img src="<?php echo "data/profile/" . $profile[0]['id'] ."-". $profile[1]['image_name']; ?>" alt="Profielfoto">
        <input type="file" name="profileImg" id="profileImg" class="new_avatar" accept="image/gif, image/jpeg, image/png, image/jpg">
        <!--ERROR = bestand is te groot  -->
        <?php if (isset($imgError)) : ?>
            <div class="form__error">
                <p><?php echo $imgError; ?></p>
            </div>
        <?php endif; ?>
        <!-- SUCCESS = bestand is upgeload  -->
        <?php if (isset($imgSuccess)) : ?>
            <div class="form__success">
                <p><?php echo $imgSuccess; ?></p>
            </div>
        <?php endif; ?>
        <!--button-->
        <input type="submit" name="uploadImg" class="btn" value="Upload Image">

        <!-- gegevens gebruiker -->
        <h2>Change Profile</h2>
        <!-- SUCCESS fistname lastname email -->
        
<?php if(isset($messageArr)): ?>
            <div class="form__success">
                <?php foreach($messageArr as $m): ?>
                <p><?php echo $m ?></p>
            </div>
                <?php endforeach; ?>
<?php endif; ?>
        <input type="text" id="firstname" name="firstname" placeholder="First name">
        <input type="text" id="lastname" name="lastname" value="" placeholder="Last name">
        <?php if (isset($emailError)) : ?>
            <div class="form__error">
                <p><?php echo $emailError; ?></p>
            </div>
        <?php endif; ?>
        <input type="email" id="email" name="email" value="" placeholder="E-mail or username">
        <!-- button -->
        <input type="submit" name="edit" class="btn" value="Change profile">

        <!-- bio toevoegen -->
        <h2>Bio</h2>
        <textarea name="bioText" rows="4" cols="44" placeholder="Profile Text"></textarea>
        <!-- button -->
        <input type="submit" name="addBio" class="btn" value="Add or change profile text">

        <!-- wachtwoord aanpassen -->
        <h2>Change Password</h2>
        <br>
        <?php if (isset($passwordError)) : ?>
            <div class="form__error">
                <p><?php echo $passwordError; ?></p>
            </div>
        <?php endif; ?>
        <h4>Old password</h4>
        <input type="password" id="oldPassword" name="oldPassword" placeholder="Old password">
        <h4>New password</h4>
        <input type="password" id="password" name="password" placeholder="New password">
        <input type="password" name="repassword" id="repassword" placeholder="Confirm new password">
        <!-- button -->
        <input type="submit" name="passwordedit" class="btn" value="Change password">
    </form>

</body>

</html>