<?php 
require("classes/ChatPrivateMessage.class.php");
require("datetime.php");

if(!empty($_POST)){

    header("Content-type: application/json");

    // new message
    $m = new ChatPrivateMessage();

    $m->setChatId($_POST['chat_id']);
    $m->setText($_POST['text_message']);
    $m->setUser1($_SESSION['user_id']);
    $m->setDate(getTime());

    $textM = $m->getText();
    echo 'you are here';

    $m->saveMessage();

    $response = [
        'status' => 'success',
        'body' => $textM
    ];
    $json = json_encode($response);

    header("Content-type: application/json");


    echo $json;
   
};


?>

