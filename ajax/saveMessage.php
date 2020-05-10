<?php 
require("../classes/Db.class.php");
require("../classes/ChatPrivateMessage.class.php");
require("../datetime.php");
session_start();  

if(!empty($_POST)){
    


    // new message
    $m = new ChatPrivateMessage();

    $m->setChatId($_POST['chat_id']);
    $m->setText($_POST['text_message']);
    $m->setUser1($_SESSION['user_id']);
    $m->setDate(getTime());

    $textM = $m->getText();

    $m->saveMessage();

    header('Content-type: application/json'); 

    $response = [
        "status" => "success",
        "body" => $m->getDate(),
        "message" => "something"
    ];
    
    echo json_encode($response);

};


?>
