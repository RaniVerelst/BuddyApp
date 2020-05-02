<?php
class ChatPrivate {

    private $user1;
    private $user2;
    private $topic;
    private $accepted;
    private $active;
    private $date;
    private $uniqueKey;
    private $chatId;

    public function requestChat(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT into chat_private(topic, user1_id, user2_id, active, accepted, created, unique_key) values(:topic, :user1, :user2, :active, :accepted, :created, :uniqueKey)");
        $statement->bindValue(':topic', $this->getTopic());
        $statement->bindValue(':user1', $this->getUser1());
        $statement->bindValue(':user2', $this->getUser2());
        $statement->bindValue(':active', 0);
        $statement->bindValue(':accepted', $this->getAccepted());
        $statement->bindValue(':created', $this->getDate());
        $statement->bindValue(':uniqueKey', $this->getUniqueKey());
        $statement->execute();
    }

    public function startChat(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE chat_private SET active = 1 WHERE unique_key = :uniqueKey");
        $statement->bindValue(':uniqueKey', $this->getUniqueKey());
        $statement->execute();
    }

    public function getChatInfoByKey(){
        $conn = DB::getInstance();

        $statement = $conn->prepare("SELECT * from chat_private WHERE  unique_key = :uniqueKey ");
        $statement->bindValue(':uniqueKey', $this->getUniqueKey());
        $statement->execute();
        $result = $statement->fetch();

        return $result;
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
     * Get the value of accepted
     */ 
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set the value of accepted
     *
     * @return  self
     */ 
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

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
     * Get the value of uniqueKey
     */ 
    public function getUniqueKey()
    {
        return $this->uniqueKey;
    }

    /**
     * Set the value of uniqueKey
     *
     * @return  self
     */ 
    public function setUniqueKey($uniqueKey)
    {
        $this->uniqueKey = $uniqueKey;

        return $this;
    }

    /**
     * Get the value of chatId
     */ 
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * Set the value of chatId
     *
     * @return  self
     */ 
    public function setChatId($chatId)
    {
        $this->chatId = $chatId;

        return $this;
    }
}
?>