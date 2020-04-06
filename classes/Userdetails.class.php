<?php

class UserDetails
{
    private $movie;
    private $destination;
    private $serie;
    private $cookie;
    private $hangout;
    private $userId;
    /**
     * Get the value of movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set the value of destination
     *
     * @return  self
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get the value of serie
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set the value of serie
     *
     * @return  self
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get the value of cookie
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * Set the value of cookie
     *
     * @return  self
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;

        return $this;
    }

    /**
     * Get the value of hangout
     */
    public function getHangout()
    {
        return $this->hangout;
    }

    /**
     * Set the value of hangout
     *
     * @return  self
     */
    public function setHangout($hangout)
    {
        $this->hangout = $hangout;

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


    public function saveUserDetails()
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into profile_details(movie, destination, cookie, serie, hangout) values(:movie, :destination, :cookie, :serie, :hangout)");

            $statement->bindValue(':movie', $this->getMovie());
            $statement->bindValue(':destination', $this->getDestination());
            $statement->bindValue(':cookie', $this->getCookie());
            $statement->bindValue(':serie', $this->getSerie());
            $statement->bindValue(':hangout', $this->getHangout());

            $result = $statement->execute();
            header("Location: index.php");
        } catch (Throwable $t) {
            return false;
        }
    }

    public function getMessage()
    {
    }

    //Get all characteristics
    public function getAllCharacteristics()
    {

        //DB connection
        $conn = Db::getInstance();

        //query
        $statement = $conn->prepare("SELECT * FROM profile_details WHERE user_id = :userId");
        $statement->bindParam(":userId", $this->userId);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
}
