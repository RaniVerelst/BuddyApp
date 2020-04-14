<?php
// FEATURE 9
require_once('User.class.php');


class Friendlist extends User  {
private $userId;

//---------Get Friend list
public function getFriendList(){

      //DB CONNECTIE
      $conn = Db::getInstance();

      //QUERY WHERE USER = $_SESSION
      $statement = $conn->prepare("SELECT user1_id, user2_id FROM friend_list WHERE user1_id = :user_id OR user2_id = :user_id");
      $user = $this->getUserId();
      $statement->bindParam(":user_id", $user);
      $statement->execute();
      $result = $statement->fetchAll();
      return $result;
}


//---------Getters & Setters

/**
 * Get the value of userId
 */ 
public function getUserId()
{
return $this->userId;
}

/**
 * Set the value of userId
 *
 * @return  self
 */ 
public function setUserId($userId)
{
$this->userId = $userId;

return $this;
}
}
?>