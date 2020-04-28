<?php

include_once('Db.class.php');

class Login
{

    private $email;
    private $password;

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function login()
    {
        //DB CONNECTIE
        $conn = Db::getInstance();
        //check if email correct
        $statement = $conn->prepare("select * from users where email like :email ");
        $statement->bindValue(':email', $this->email);
        $statement->execute();
        $emailExist = $statement->rowCount();
        $profile = $statement->fetch();

        if ($emailExist == 1) {
            //get password from db
            $password = $profile['password'];

            //validate password
            if ($this->loginPassword($password)) {
                //save userId in session
                session_start();
                $_SESSION["user_id"] = $profile['id'];
                $_SESSION['email'] = $this->email;
                header('location:index.php');

                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    // ---------------validate password------------ 
    public function loginPassword($password)
    {

        //compare hashpassword to given password
        if (password_verify($this->getPassword(), $password)) {
            return true;
        } else {
            return false;
        }
    }
}
