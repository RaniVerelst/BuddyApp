<?php 
require_once('ChatPrivate.class.php');
class ChatPrivateMessage extends ChatPrivate{
   private $text;

   public function saveMessage(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("INSERT into chat_private_messages(chat_id, user_id, send_on, text_message) values(:chatId, :user1, :created, :textMessage)");
    $statement->bindValue(':chatId', $this->getChatId());
    $statement->bindValue(':user1', $this->getUser1());
    $statement->bindValue(':created', $this->getDate());
    $statement->bindValue(':textMessage', $this->getText());
    echo 'you inside';
    $statement->execute();
   }
   /**
    * Get the value of text
    */ 
   public function getText()
   {
      return $this->text;
   }

   /**
    * Set the value of text
    *
    * @return  self
    */ 
   public function setText($text)
   {
      $this->text = htmlspecialchars($text);

      return $this;
   }
}
?>