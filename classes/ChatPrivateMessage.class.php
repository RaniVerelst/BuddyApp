<?php 
require_once('ChatPrivate.class.php');
class ChatPrivateMessage extends ChatPrivate{
   private $text;
   private $messageId;

   public function saveMessage(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("INSERT into chat_private_message(chat_id, user_id, send_on, text_message) values(:chatId, :user1, :created, :textMessage)");
    $statement->bindValue(':chatId', $this->getChatId());
    $statement->bindValue(':user1', $this->getUser1());
    $statement->bindValue(':created', $this->getDate());
    $statement->bindValue(':textMessage', $this->getText());

    $statement->execute();
   }

   public function getMessages(){
      $conn = Db::getInstance();

      $statement = $conn->prepare("SELECT * FROM chat_private_message WHERE chat_id = :chatId AND seen = 0 AND user_id NOT LIKE :userId ORDER BY send_on ASC LIMIT 1");
      $statement->bindValue(':chatId', $this->getChatId());
      $statement->bindValue(':userId', $this->getUser1());
      $statement->execute();
      $result = $statement->fetch();

      $count = $statement->rowCount();

      if($count <1){
         return false;
      }
      $m = $result[0];

      $statement2 = $conn->prepare("UPDATE chat_private_message SET seen = 1 WHERE id = :messageId");
      $statement2->bindValue(':messageId', $m);
      $statement2->execute();


      return $result;

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

   /**
    * Get the value of messageId
    */ 
   public function getMessageId()
   {
      return $this->messageId;
   }

   /**
    * Set the value of messageId
    *
    * @return  self
    */ 
   public function setMessageId($messageId)
   {
      $this->messageId = $messageId;

      return $this;
   }
}
?>