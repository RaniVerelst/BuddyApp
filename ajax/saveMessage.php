<?php 
require("../classes/Db.class.php");
require("../classes/ChatPrivateMessage.class.php");
require("../datetime.php");
session_start();  

if(!empty($_POST)){
    
    header("Content-type: application/json");

    // new message
    $m = new ChatPrivateMessage();

    $m->setChatId($_POST['chat_id']);
    $m->setText($_POST['text_message']);
    $m->setUser1($_SESSION['user_id']);
    $m->setDate(getTime());

    $textM = $m->getText();

    echo $textM;

    $m->saveMessage();

    $response = [
        "status" => "success",
        "body" => "something",
        "message" => "something"
    ];

    header('Content-type:application/json'); 

    echo json_encode($response);

   
};


?>
