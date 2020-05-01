<?php


class Profile
{
    private $bio;
    private $userId;
    private $userName;




    /**
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

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
        $_SESSION['user_id'] = $userId;

        return $this;
    }

    public function saveBio()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into profile (bio, userId) values (:bio, :userId)");

        $bio = $this->getBio();
        $userId = $this->getUserId();

        $statement->bindvalue(":text", $bio);
        $statement->bindValue(":userId", $userId);

        $result = $statement->execute();
        return $result;
    }

    public static function getAll($postId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('select * from comments where postId = :postId');
        $statement->bindvalue(":postId", $postId);
        $result = $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
