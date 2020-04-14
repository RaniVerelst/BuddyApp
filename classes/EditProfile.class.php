<?php 
// FEATURE 3

require_once('User.class.php');

class EditProfile extends User {
  private $userId;
// img
  private $imageName;
  private $imageSize;
  private $imageTmpName;
// bio
  private $bio;


  public function getUserInfo()
  {
       //DB CONNECTIE
       $conn = Db::getInstance();

       //QUERY WHERE USER = $_SESSION
       $statement = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
       $statement->bindParam(":user_id", $this->userId);
       $statement->execute();
   
       $secondStatement = $conn->prepare("SELECT * FROM profile_image WHERE user_id = :userid LIMIT 1");
       $secondStatement->bindParam(":userid", $this->userId);
       $secondStatement->execute();
       //concat 2 db
       $result = [$statement->fetch(), $secondStatement->fetch()];
       return $result;
  }


 // ---------------UPLOAD IMAGE ------------

  public function SaveProfileImg($query)
  {
    //Connect to db
    $conn = Db::getInstance();
    $statement = $conn->prepare($query);

    // get img
    $imgName = $this->getuserId() . '-' . $this->getImageName();
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
    if(password_verify($password, $userProfile[0]['password'])){
  return true;
    } else {
  return false;
    }
  }

//-------------------GETTERS & SETTERS 

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


  public function getuserId()
  {
    return $this->userId;
  }
  
  public function setuserId($userId)
  {
    $this->userId = htmlspecialchars($userId);
    return $this;
  }
  
}

?>