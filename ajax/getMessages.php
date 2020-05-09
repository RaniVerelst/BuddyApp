<?php
require("../classes/Db.class.php");
require("../classes/ChatPrivateMessage.class.php");
require("../datetime.php");
session_start();  

if(!empty($_POST)){

    // new message
    $m = new ChatPrivateMessage();

    $m->setChatId($_POST['chat_id']);
    $m->setUser1($_SESSION["user_id"]);


    $message = $m->getMessages();

    
    header('Content-type: application/json'); 
    
    echo json_encode($message, true);

};

?>