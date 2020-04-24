<?php
require_once "User.class.php";
class UserDetails extends User
{

    private $movie;
    private $destination;
    private $serie;
    private $cookie;
    private $hangout;
    private $class;
    private $skills;
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

         /**
     * Get the value of class
     */ 
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the value of class
     *
     * @return  self
     */ 

    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }
    public function setHangout($hangout)
    {
        $this->hangout = $hangout;

        return $this;
    }
    /**
     * Get the value of skills
     */ 
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set the value of skills
     *
     * @return  self
     */ 
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }


    public function saveUserDetails()
    {

        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into profile_details(movie, destination, serie, cookie, hangout, class, skills) values(:movie, :destination, :serie, :cookie, :hangout, :class, :skills)");

            $statement->bindValue(':movie', $this->getMovie());
            $statement->bindValue(':destination', $this->getdestination());
            $statement->bindValue(':serie', $this->getSerie());
            $statement->bindValue(':cookie', $this->getCookie());
            $statement->bindValue(':hangout', $this->getHangout());
            $statement->bindValue(':class', $this->getClass());
            $statement->bindValue(':skills', $this->getSkills());
            $result = $statement->execute();

            header("Location: index.php");
        } catch (Throwable $e) {
            echo "Niet gelukt";
            return false;
        }
    }




    //Get all characteristics
    public function getAllCharacteristics()
    {

        //DB connection
        $conn = Db::getInstance();

        //query
        $statement = $conn->prepare("SELECT * FROM profile_details WHERE user_id = :userId");
        $userId = $this->getuserId();
        $statement->bindParam(":userId", $userId);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }




}
