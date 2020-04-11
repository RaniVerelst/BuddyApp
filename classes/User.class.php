<?php

class User
{
  private $firstname;
  private $lastname;
  private $username;
  private $email;
  private $password;
  private $passwordConfirm;
  // private $userId; // om profiel aan te passen
 // private $bio;

  //temp voor IMAGE UPLOAD
  /*private $imageName;
  private $imageSize;
  private $imageTmpName;*/



  // ontvang de firstname
  public function getFirstname()
  {
    return $this->firstname;
  }

  public function setFirstname($firstname)
  {
    if (empty($firstname)) {
      throw new Exception("Firstname can't be empty");
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
      throw new Exception("Lastname can't be empty");
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
    $this->email = $email;
    return $this;
  }

  // ontvang password
  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
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
      throw new Exception("Invalid Email!");
    }
    if (strlen($this->password) < 8) {
      throw new Exception("Your password needs to be 8 characters long.");
    }
    if ($this->password != $this->passwordConfirm) {
      throw new Exception("Oops, passwords don't match.");
    }
    if (!stristr($this->email, $endemail)) {
      throw new Exception("Email must end on @student.thomasmore.be");
    }
    if ($exist == true) {
      throw new Exception("Email already exist");
    }
    // voor register te confirmen
    $options = [
      "cost" => 12 // 2^12
    ];
    $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

    try {
      $conn = Db::getInstance();
      $statement = $conn->prepare("insert into users(first_name, last_name, user_name, email, password) values(:firstname, :lastname, :username, :email, :password)");

      $statement->bindValue(':firstname', $this->getFirstname());
      $statement->bindValue(':lastname', $this->getLastname());
      $statement->bindValue(':username', $this->getUsername());
      $statement->bindValue(':email', $this->getEmail());
      $statement->bindValue(':password', $password);


      $result = $statement->execute();
      $username = "";
      $_SESSION['username'] = $username;
      header("Location: profile_details.php");
    } catch (Throwable $e) {
      echo "Niet gelukt";
      return false;
    }
  }




  //////////////////////////////////////////////////
  ///////////////// PROFIEL AANPASSEN ///////////// feature 3
  ////////////////////////////////////////////////

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
/*

 // ---------------UPLOAD IMAGE ------------

  public function SaveProfileImg($query)
  {
    //Connect to db
    $conn = Db::getInstance();
    $statement = $conn->prepare($query);

    // get img
    $imgName = $this->userId . '-' . $this->getImageName();
    $imgTmp = $this->getImageTmpName();
    
      //bind
      $statement->bindValue(":imgName", $this->getImageName());
      $statement->bindValue(":imgSize", $this->getImageSize());
      $statement->bindValue(":imgTmp", $this->getImageTmpName());
      $statement->bindValue(":userId", $this->userId);
      $statement->execute();
      $result = $statement->fetchAll();
      //save img in directory
      $dir = "data/profile/";
      move_uploaded_file($imgTmp, $dir . $imgName);
      return $result;
  } // end SaveProfileImg


  // ---------------CHANGE FIRSTNAME------------

  public function saveFirstname(){
    //connect to db
    $conn = Db::getInstance();
    //query
    //
    $statement = $conn->prepare("UPDATE users SET first_name = :firstname WHERE id = :userId");
    $statement->bindValue(":firstname",$this->getFirstname() );
    $statement->bindValue(":userId", $this->userId);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
  }
  

 // ---------------CHANGE LASTNAME ------------

    //set up First name
    public function saveLastname(){
      //connect to db
      $conn = Db::getInstance();
      //query
      $statement = $conn->prepare("UPDATE users SET last_name = :lastname WHERE id = :userId");
      $statement->bindValue(":lastname",$this->getLastname());
      $statement->bindValue(":userId", $this->userId);
      $statement->execute();
      $result = $statement->fetchAll();
      return $result;
    }


    // ---------------CHANGE EMAIL------------

    public function saveEmail(){
      //connect to db
      $conn = Db::getInstance();
      //query
      $statement = $conn->prepare("UPDATE users SET email = :email WHERE id = :userId");
      $statement->bindValue(":email",$this->getEmail());
      $statement->bindValue(":userId", $this->userId);
      $statement->execute();
      $result = $statement->fetchAll();
      return $result;
    }
  
    //check if email exists --> for update
    public function emailExists($email)
    {
      $conn = Db::getInstance();
      $statement = $conn->prepare("select * from users where email = :email");
      $statement->bindParam(":email", $email);
      $statement->execute();
      $count = $statement->rowCount();
      if ($count > 0) {
        return true;
      } else {
        return false;
      }
    }


  // ---------------ADD/CHANGE BIO ------------

  function saveBio(){
     //connect to db
     $conn = Db::getInstance();
     //query
     $statement = $conn->prepare("UPDATE users SET bio = :bio WHERE id = :userId");
     $statement->bindValue(":bio", $this->getBio());
     $statement->bindValue(":userId", $this->userId);
     $statement->execute();
     $result = $statement->fetchAll();
     return $result;
  }


  // ---------------CHANGE PASSWORD ------------

  function savePassword(){
    $options = [
      "cost" => 12 // 2^12
    ];
    $password = password_hash($this->getPassword(), PASSWORD_DEFAULT, $options);
    //connect to db
     $conn = Db::getInstance();
     //query
     $statement = $conn->prepare("UPDATE users SET password = :newpassword WHERE id = :userId");
     $statement->bindValue(":newpassword", $password);
     $statement->bindValue(":userId", $this->userId);
     $statement->execute();
     $result = $statement->fetchAll();
     return $result;
  }

  public function passwordExists($password)
  {
    $userProfile = $this->getUserInfo();
    //var_dump($userProfile[0]['password']);
    if(password_verify($password, $userProfile[0]['password'])){
  return true;
    } else {
  return false;
    }
  }

//-------------------GETTERS & SETTERS 

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

// getters and settters img
public function getimageName()
{
  return $this->imageName;
}

public function setimageName($imageName)
{
  $this->imageName = $imageName;

  return $this;
}

public function getimageSize()
{
  return $this->imageSize;
}

public function setimageSize($imageSize)
{
  $this->imageSize = $imageSize;

  return $this;
}

public function getimageTmpName()
{
  return $this->imageTmpName;
}

public function setimageTmpName($imageTmpName)
{
  $this->imageTmpName = $imageTmpName;

  return $this;
}
// getters & setters bio
/**
   * Get the value of bio
   */ /*
  public function getBio()
  {
    return $this->bio;
  }

  /**
   * Set the value of bio
   *
   * @return  self
   */ /*
  public function setBio($bio)
  {
    $this->bio = $bio;

    return $this;
  }*/


  // ---------------zoek een user------------
  public function searchUser($searchkey)
  {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from users where first_name like '$searchkey%'
          union select * from users where last_name like '$searchkey%'
          union select * from users where user_name like '$searchkey%'");
    $statement->bindValue(1, '$searchkey%', PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
  }

  // details van user

  public function showUser($searchkey)
  {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from users where first_name like '$searchkey%'
          union select * from users where last_name like '$searchkey%'
          union select * from users where user_name like '$searchkey%'"); 
//    $statement = $conn->prepare("SELECT * FROM users, profile_details WHERE users.id = profile_details.ID");
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
      "select * from profile_details where movie like '$searchkey%'
          union select * from profile_details where destination like '$searchkey%'
          union select * from profile_details where cookie like '$searchkey%'
          union select * from profile_details where serie like '$searchkey%'
          union select * from profile_details where hangout like '$searchkey%'"
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
      "select * from profile_details where movie like '$searchkey%'
          union select * from profile_details where destination like '$searchkey%'
          union select * from profile_details where cookie like '$searchkey%'
          union select * from profile_details where serie like '$searchkey%'
          union select * from profile_details where hangout like '$searchkey%'"
    );    
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  // ---------------einde zoek een kenmerk------------


/*
  // ---------------zoek een user of kenmerk------------
  public function searchAll($searchkey)
  {
    $conn = Db::getInstance();
    $statement = $conn->prepare(
          "select * from users, profile_details like '$searchkey%'
          union select * from users where first_name like '$searchkey%'
          union select * from users where last_name like '$searchkey%'
          union select * from users where user_name like '$searchkey%'
          union select * from profile_details where movie like '$searchkey%'
          union select * from profile_details where destination like '$searchkey%'
          union select * from profile_details where cookie like '$searchkey%'
          union select * from profile_details where serie like '$searchkey%'
          union select * from profile_details where hangout like '$searchkey%'");
    $statement->bindValue(1, '$searchkey%', PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
  }

  // details van user of kenmerk

  public function showAll($searchkey)
  {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from users, profile_details where first_name like '$searchkey%'
    union select * from users where last_name like '$searchkey%'
    union select * from users where user_name like '$searchkey%'
    union select * from profile_details where movie like '$searchkey%'
    union select * from profile_details where destination like '$searchkey%'
    union select * from profile_details where cookie like '$searchkey%'
    union select * from profile_details where serie like '$searchkey%'
    union select * from profile_details where hangout like '$searchkey%'");    
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  // ---------------einde zoek een user of kenmerk------------
*/


  
}
