<?php
require('classes/ChatPrivateMessage.class.php');
require_once('classes/User.class.php');
//get info over conversations
$privateChat = new ChatPrivate();
$user = new User();

$user->setuserId($_SESSION['user_id']);
$u = $user->getUser();
$nick = $u[2];

$privateChat->setUniqueKey($keyChat);
$chatInfo = $privateChat->getChatInfoByKey();
$chatTopic = $chatInfo[1];
$privateChat->setUser1($_SESSION['user_id']);


/*
Set up header & encourage message 
*/
// set up header and encourage message for users
function findChatHeader($topic, $characteristics){
    $chatT = [];
    if($topic == "design" || $topic == "development"){
        $chatT[0] = "Feedback";
        $chatT[1] = '"There is no failure. Only feedback." <br>   – Robert Allen';
      } else {
        $chatT[0] = "BuddyTalk";        
        if(isset($characteristics)){
            shuffle($characteristics); 
            $charM = $characteristics[0];
        } else {
            $charM = "find out!";
        }
        $chatT[1] = "You both like " . $charM;
      }
      return $chatT;
}

//check if buddy was set 
if(isset($buddyChatCharacteristics)){
    $chatHeader = findChatHeader($chatTopic, $buddyChatCharacteristics);
} else {
    $chatHeader = findChatHeader($chatTopic, []);
}

$chatId = $chatInfo[0];

?>

<!-- chat container -->
<div>
    <h2>Chat</h2>
    <div>
        <h4><?php echo $chatHeader[0] ?></h4>
        <p><?php echo $chatHeader[1] ?></p>
    </div>
    <div class="messages-container">
        <!-- Messages -->
        <div class="messages">
        <div class="message-container">
                <p>User <span>time</span></p>
                <p>
                    message
                </p>
        </div>
        </div>
        <!-- end messages 
    write message-->
        <div>
            <input type="text" name="" id="privateMessageText" placeholder="Write message here">
        </div>
        <!-- add message -->
        <div>
            <a href="" id="btnSendPrivateMessage" data-chatid="<?php echo htmlspecialchars($chatId);?>" data-userName="<?php echo $nick?>"> Send </a>
        </div>
    </div>
</div>

