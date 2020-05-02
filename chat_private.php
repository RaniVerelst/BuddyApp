<?php
//get info over conversations
$privateChat = new ChatPrivate();

$privateChat->setUniqueKey($keyChat);
$chatInfo = $privateChat->getChatInfoByKey();
$chatTopic = $chatInfo[1];

// set up header and encourage message for users
function findChatHeader($topic, $characteristics){
    $chatT = [];
    if($topic == "design" || $topic == "development"){
        $chatT[0] = "Feedback";
        $chatT[1] = '"There is no failure. Only feedback." <br>   – Robert Allen';
      } else {
        $chatT[0] = "BuddyTalk";
        shuffle($characteristics); 
        $chatT[1] = "You both like " . $characteristics[0];
      }
      return $chatT;
}

//check if buddy was set 
if(isset($buddyChatCharacteristics)){
    $chatHeader = findChatHeader($chatTopic, $buddyChatCharacteristics);
} else {
    $chatHeader = findChatHeader($chatTopic, []);
}



?>
<!-- chat container -->
<div>
    <h2>Chat</h2>
    <div>
        <h4><?php echo $chatHeader[0] ?></h4>
        <p><?php echo $chatHeader[1] ?></p>
    </div>
    <div>
        <!-- Messages -->
        <div>
            <div>
                <p>User <span>time</span></p>
                <p>
                    First message
                </p>
            </div>
            <div>
                <p>User <span>time</span></p>
                <p>
                    Answer message
                </p>
            </div>
        </div>
        <!-- end messages 
    write message-->
        <div>
            <input type="text" name="" id="" placeholder="Write message here">
        </div>
        <!-- add message -->
        <div>
            <a href="" data-postId="<?php echo $postId; ?>"> Send </a>
        </div>
    </div>
</div>