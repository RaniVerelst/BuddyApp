<?php
require_once('Userdetails.class.php');

class Feedback extends UserDetails{
    private $topic;
    private $date;
    private $currentUser;
    private $link;
    private $user1;
    private $user2;
    private $user3;
    


    public function requestFeedback(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into feedback(topic, sender_id, link, send_on, user1_id, user2_id, user3_id) values(:topic, :sender, :link, :date, :user1, :user2, :user3)");
    
        $statement->bindValue(':topic', $this->getTopic());
        $statement->bindValue(':sender', $this->getCurrentUser());
        $statement->bindValue(':link', $this->getLink());
        $statement->bindValue(':date', $this->getDate());
        $statement->bindValue(':user1', $this->getUser1());
        $statement->bindValue(':user2', $this->getUser2());
        $statement->bindValue(':user3', $this->getUser3());
        $statement->execute();
    }
    
    public function findFeedbacker(){

        $conn = Db::getInstance();
        $statement= $conn->prepare("SELECT user_id, class FROM profile_details WHERE skills = :skills OR skills = 'both' AND NOT user_id = :sender LIMIT 3");
        $statement->bindValue(':skills', $this->getTopic());
        $statement->bindValue(':sender', $this->getCurrentUser());
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    
    public function getAllActiveFeedbacksRequests(){
        $conn = Db::getInstance();

        $statement= $conn->prepare("SELECT sender_id, link, send_on, topic FROM feedback WHERE closed = 0 AND (user1_id = :currentUser OR user2_id = :currentUser or user3_id = :currentUser)");
        $statement->bindValue(':currentUser', $this->getCurrentUser());
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
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
     * Get the value of user3
     */ 
    public function getUser3()
    {
        return $this->user3;
    }

    /**
     * Set the value of user3
     *
     * @return  self
     */ 
    public function setUser3($user3)
    {
        $this->user3 = $user3;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of currentUser
     */ 
    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    /**
     * Set the value of currentUser
     *
     * @return  self
     */ 
    public function setCurrentUser($currentUser)
    {
        $this->currentUser = $currentUser;

        return $this;
    }
}
?>