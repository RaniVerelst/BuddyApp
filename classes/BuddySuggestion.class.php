<?php
require_once('Userdetails.class.php');

class BuddySuggestion extends UserDetails{
//find 
private $date;
private $user1;
private $user2;
private $buddyMentorMode;

public function becomeBuddyMentor(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("UPDATE profile_details SET buddy_mentor = :buddyState WHERE id= :currentUser");
    $statement->bindValue(':currentUser', $this->getCurrentUser());
    $statement->bindValue(':buddyState', $this->getBuddyMentorMode());
    $result = $statement->execute();
}

public function findBuddyMentor(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("SELECT * FROM profile_details WHERE buddy_mentor = 1 AND (movie = :movie OR  destination = :destination  OR  cookie = :cookie OR  serie = :serie OR hangout = :hangout) ORDER BY rand()");
    $statement->bindValue(':movie', $this->getMovie());
    $statement->bindValue(':destination', $this->getDestination());
    $statement->bindValue(':cookie', $this->getCookie());
    $statement->bindValue(':serie', $this->getSerie());
    $statement->bindValue(':hangout', $this->getHangout());
    $statement->execute();
    $result = $statement->fetch();
    return $result;
}

public function requestConversation(){
    $conn = Db::getInstance();
    $statement = $conn->prepare("insert into buddy_suggestion");

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


/**
 * Get the value of buddyMentorMode
 */ 
public function getBuddyMentorMode()
{
return $this->buddyMentorMode;
}

/**
 * Set the value of buddyMentorMode
 *
 * @return  self
 */ 
public function setBuddyMentorMode($buddyMentorMode)
{
$this->buddyMentorMode = $buddyMentorMode;

return $this;
}
} //end class
?>