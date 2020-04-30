<?php
require_once('Userdetails.class.php');

class BuddySuggestion extends UserDetails{
//find 
private $topic;
private $date;
private $user1;
private $user2;

public function requestConversation(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("insert into buddy_suggestion(topic, user1_id, started) values(:topic, :user1, :date)");

    $statement->bindValue(':topic', $this->getTopic());
    $statement->bindValue(':user1', $this->getUser1());
    $statement->bindValue(':date', $this->getDate());
    $result = $statement->execute();


}

//---------getters & setters
/**
 * Get the value of topic
 */ 
public function getTopic()
{
return $this->topic;
}

/**
 * Set the value of topic
 *
 * @return  self
 */ 
public function setTopic($topic)
{
$this->topic = $topic;

return $this;
}


/**
 * Get the value of date
 */ 
public function getDate()
{
return $this->date;
}

/**
 * Set the value of date
 *
 * @return  self
 */ 
public function setDate($date)
{
$this->date = $date;

return $this;
}

/**
 * Get the value of user1
 */ 
public function getUser1()
{
return $this->user1;
}

/**
 * Set the value of user1
 *
 * @return  self
 */ 
public function setUser1($user1)
{
$this->user1 = $user1;

return $this;
}

/**
 * Get the value of user2
 */ 
public function getUser2()
{
return $this->user2;
}

/**
 * Set the value of user2
 *
 * @return  self
 */ 
public function setUser2($user2)
{
$this->user2 = $user2;

return $this;
}

} //end class
?>