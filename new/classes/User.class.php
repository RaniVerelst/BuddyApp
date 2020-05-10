<?php

class User
{
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $passwordConfirm;
    private $userId;
    // private $bio;

    // ontvang de firstname
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        if (empty($firstname)) {
            throw new Exception("Oops, voornaam is nog niet ingevuld.");
        } else {
            $this->firstname = htmlspecialchars($firstname);
            return $this;
        }
        /*$this->firstname = $firstname;
    return $this;*/
    }

    // ontvang de lastname
    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        if (empty($lastname)) {
            throw new Exception("Oops, achternaam is nog niet ingevuld.");
        } else {
            $this->lastname = htmlspecialchars($lastname);
            return $this;
        }
        /*$this->lastname = $lastname;
    return $this;*/
    }


    // ontvang de username
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    // ontvang email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = htmlspecialchars($email);
        return $this;
    }

    // ontvang password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = htmlspecialchars($password);
        return $this;
    }
    // voor register te confirmen
    public function getpasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    public function setpasswordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;
        return $this;
    }


    public function register()
    {
        // formulier
        $conn = Db::getInstance();
        $email = $this->getEmail();
        $result = $conn->prepare("SELECT * FROM users WHERE email= :email");
        $result->bindParam(":email", $email);
        $result->execute();
        $count = $result->rowCount();
        $endemail = "student.thomasmore.be";
        // $num_rows = mysqli_num_rows($result);

        if (isset($_POST['email'])) {

            if ($count > 0) {
                $exist = true;
            }
        }
        //prepare statement
        $endemail = "student.thomasmore.be";
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Dit email adres is niet geldig.");
        }
        if (strlen($this->password) < 8) {
            throw new Exception("Je passwoord moet minstens 8 karakters lang zijn");
        }
        if ($this->password != $this->passwordConfirm) {
            throw new Exception("Oops, passwoorden komen niet overeen.");
        }
        if (!stristr($this->email, $endemail)) {
            throw new Exception("Email moet eindigen op @student.thomasmore.be");
        }
        if ($exist == true) {
            throw new Exception("Email adres is al in gebruik.");
        }
        // voor register te confirmen
        $options = [
            "cost" => 12 // 2^12
        ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into users(first_name, last_name, user_name, email, password, bio) values(:firstname, :lastname, :username, :email, :password, 'Your bio is empty')");

            $statement->bindValue(':firstname', $this->getFirstname());
            $statement->bindValue(':lastname', $this->getLastname());
            $statement->bindValue(':username', $this->getUsername());
            $statement->bindValue(':email', $this->getEmail());
            $statement->bindValue(':password', $password);

            $result = $statement->execute();
            //Set up session
            session_start();
            $currentUser = $this->getUserIdFromDb();
            $_SESSION['user_id'] = $currentUser;
            $_SESSION['email'] = $this->email;


            header("Location: details.php");
        } catch (Throwable $e) {
            echo "Niet gelukt";
            return false;
        }
    }

    function getUserIdFromDb()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id FROM users WHERE user_name like :username");
        $statement->bindValue(':username', $this->getUsername());
        $result = $statement->execute();

        return $result;
    }
    //////////////////////////////////////////////////
    ///////////////// INLOGGEN  ///////////// feature 1
    ////////////////////////////////////////////////

    // ---------------check email ------------ 

    //////////////////////////////////////////////////
    ///////////////// PROFIEL AANPASSEN ///////////// feature 3
    ////////////////////////////////////////////////
    // getters and setters USERID
    public function getuserId()
    {
        return $this->userId;
    }

    public function setuserId($userId)
    {
        $this->userId = htmlspecialchars($userId);
        return $this;
    }

    function __toString()
    {
        return $this->getuserId();
    }

    public function getUserInfo()
    {
        //DB CONNECTIE
        $conn = Db::getInstance();

        //QUERY WHERE USER = $_SESSION
        $statement = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
        $statement->bindParam(":user_id", $this->userId);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }


    // ---------------zoek een user------------
    public function searchUser($searchkey)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users, profile_details where first_name like '$searchkey%' AND users.id = profile_details.ID
      union select * from users, profile_details where last_name like '$searchkey%' AND users.id = profile_details.ID
      union select * from users, profile_details where user_name like '$searchkey%' AND users.id = profile_details.ID");
        $statement->bindValue(1, '$searchkey%', PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
    // details van user

    public function showUser($searchkey)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from users, profile_details where first_name like '$searchkey%' AND users.id = profile_details.ID
    union select * from users, profile_details where last_name like '$searchkey%' AND users.id = profile_details.ID
    union select * from users, profile_details where user_name like '$searchkey%' AND users.id = profile_details.ID");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    // ---------------einde zoek een user------------
    // ---------------zoek een kenmerk------------

    public function searchKenmerk($searchkey)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare(
            "select * from profile_details, users where movie like '$searchkey%' AND profile_details.ID = users.id
          union select * from profile_details, users where destination like '$searchkey%' AND profile_details.ID = users.id
          union select * from profile_details, users where cookie like '$searchkey%' AND profile_details.ID = users.id
          union select * from profile_details, users where serie like '$searchkey%' AND profile_details.ID = users.id
          union select * from profile_details, users where hangout like '$searchkey%' AND profile_details.ID = users.id"
        );
        $statement->bindValue(1, '$searchkey%', PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    // details van kenmerk

    public function showKenmerk($searchkey)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare(
            "select * from profile_details, users where movie like '$searchkey%' AND profile_details.ID = users.id
            union select * from profile_details, users where destination like '$searchkey%' AND profile_details.ID = users.id
            union select * from profile_details, users where cookie like '$searchkey%' AND profile_details.ID = users.id
            union select * from profile_details, users where serie like '$searchkey%' AND profile_details.ID = users.id
            union select * from profile_details, users where hangout like '$searchkey%' AND profile_details.ID = users.id"
        );
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // ---------------einde zoek een kenmerk------------


    //////////// Feature 13 -> 
    //// count all users
    public function countUsers()
    {
        //DB CONNECTIE
        $conn = Db::getInstance();

        //QUERY WHERE USER = $_SESSION
        $statement = $conn->prepare("SELECT * FROM users ");
        $statement->execute();
        $count = $statement->rowCount();

        return $count;
    }


    // ---------------zoek een room------------
    public function searchRoom($searchkey)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from room where room_number like '$searchkey%'
    union select * from room where floor like '$searchkey%' 
    union select * from room where capacity like '$searchkey%' 
    union select * from room where campus like '$searchkey%'");
        $statement->bindValue(1, '$searchkey%', PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    // ---------------details van een room------------
    public function showRoom($searchkey)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from room where room_number like '$searchkey%'
      union select * from room where floor like '$searchkey%' 
      union select * from room where capacity like '$searchkey%' 
      union select * from room where campus like '$searchkey%'");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
