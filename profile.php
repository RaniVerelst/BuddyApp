^<?php
    include_once(__DIR__ . "/classes/profile.class.php");
    include_once(__DIR__ . "/classes/User.class.php");
    include_once(__DIR__ . "/classes/Userdetails.class.php");
    include_once(__DIR__ . "/classes/Db.class.php");
    session_start();


    if (isset($_SESSION['email'])) {
        $userId = $_SESSION['user_id'];
        //find user id

    } else {
        header("location: login.php");
    }

    if (!empty($_POST)) {

        $bio = $_POST['email'];
        //set up email & password 
        $profile = new Profile();
        $profile->setBio($profile);

        $result = $profile->saveBio();
    }

    $allComments = Profile::getAll(3);
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="startbootstrap/css/freelancer.min.css" rel="stylesheet">
    <title>My profile</title>
</head>

<body>
    <form class="form_signup" method="post" name="profile_form" action="">
        <div class="post form_profile">
            <h2><?php echo $userId ?></h2>
            <div class="post__bio ">
                <div class="post__bio__form">
                    <input type="text" id="bioText" placeholder="Who are you?">
                    <a href="#" class="btn bg-primary" id="btnAddBio" data-postid="3">Add bio</a>
                    <a href="#" class="btn" id="btnChangeBio" data-postid="3">Change bio</a>

                </div>


            </div>

        </div>

    </form>

    <script src="app.js"></script>
</body>

</html>