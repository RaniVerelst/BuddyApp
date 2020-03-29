<?php
include_once("classes/db.class.php");

class User
{
  private $firstname;
  private $lastname;
  private $username;
  private $email;
  private $password;
  private $password_confirm;
  private $user_id; //is nodig om profiel aan te passen

  //temp voor IMAGE UPLOAD
  private $ImageName;
  private $ImageSize;
  private $ImageTmpName;
  private $imgExtenssionError;


  // krijg de waarde van username
  public function getFirstname()
  {
    return $this->firstname;
  }

  public function setFirstname($firstname)
  {
    if (empty($firstname)) {
      throw new Exception("Firstname cannot be empty");
    } else {
      $this->firstname = htmlspecialchars($firstname);
      return $this;
    }
    /*$this->firstname = $firstname;
    return $this;*/
  }

  public function getLastname()
  {
    return $this->lastname;
  }

  public function setLastname($lastname)
  {
    if (empty($lastname)) {
      throw new Exception("Lastname cannot be empty");
    } else {
      $this->lastname = htmlspecialchars($lastname);
      return $this;
    }
    /*$this->lastname = $lastname;
    return $this;*/
  }


  // krijg de waarde van username
  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    $this->username = $username;
    return $this;
  }

  // krijg de waarde Email
  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
    return $this;
  }

  // krijgt de waarde van password
  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
    return $this;
  }
  // voor register2
  public function getPassword_confirm()
  {
    return $this->password_confirm;
  }

  public function setPassword_confirm($password_confirm)
  {
    $this->password_confirm = $password_confirm;
    return $this;
  }



  public function register()
  {
    // form validation
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception("Invalid Email");
    }
    if (strlen($this->password) < 8) {
      throw new Exception("Your password needs at leats 8 characters");
    }
    if ($this->password != $this->password_confirm) {
      throw new Exception("Passwords don't match");
    } else {
      // voor register 2
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
        // return $result;
        $username = "";
        $_SESSION['username'] = $username;
        header("Location: index.php");
      } catch (Throwable $t) {
        echo "mislukt";
        return false;
      }
    }
  }


  //////////////////////////////////////////////////
  ///////////////// PROFIEL AANPASSEN ///////////// feature 3
  ////////////////////////////////////////////////

  public function getUser_id()
  {
    return $this->user_id;
  }

  public function setUser_id($user_id)
  {
    $this->user_id = htmlspecialchars($user_id);
    return $this;
  }


  public function getUserInfo()
  {
    //DB CONNECTIE
    $conn = Db::getInstance();

    //QUERY WHERE USER = $_SESSION
    $statement = $conn->prepare("SELECT * FROM users WHERE id = :user_id LIMIT 1");
    $statement->bindParam(":user_id", $this->user_id);
    $statement->execute();

    $secondStatement = $conn->prepare("SELECT * FROM profile_image WHERE user_id = :userid LIMIT 1");
    $secondStatement->bindParam(":userid", $this->user_id);
    $secondStatement->execute();
    //concat 2 db
    $result = [$statement->fetch(), $secondStatement->fetch()];
    return $result;
  }


  public function getImageName()
  {
    return $this->ImageName;
  }

  public function setImageName($ImageName)
  {
    $this->ImageName = $ImageName;

    return $this;
  }

  public function getImageSize()
  {
    return $this->ImageSize;
  }

  public function setImageSize($ImageSize)
  {
    $this->ImageSize = $ImageSize;

    return $this;
  }

  public function getImageTmpName()
  {
    return $this->ImageTmpName;
  }

  public function setImageTmpName($ImageTmpName)
  {
    $this->ImageTmpName = $ImageTmpName;

    return $this;
  }

  // SAVE profielafbeelding 
  public function SaveProfileImg($query)
  {
    //Connect to db
    $conn = Db::getInstance();
    $sql = $conn->prepare($query);

    // get img
    $imgName = $this->getImageName();
    $imgTmp = $this->getImageTmpName();
    $tmp = explode('.', $imgName);

    $imgExtension = end($tmp);
    $dir = "data/profile/";
    // check format
    $expensions = array("jpeg", "jpg", "png", "gif");

    if (in_array($imgExtension, $expensions) === false) {
      //throw new Exception();
      $m = "extension not allowed, please choose a JPEG or PNG or GIF file.";
      $this->setImgExtenssionError($m);
      return false;
    } else {
      //bind
      $sql->bindValue(":imgName", $this->getImageName());
      $sql->bindValue(":imgSize", $this->getImageSize());
      $sql->bindValue(":imgTmp", $this->getImageTmpName());
      $sql->bindValue(":userId", $this->getUser_id());
      $sql->execute();
      $result = $sql->fetchAll();
      //save img in directory
      move_uploaded_file($imgTmp, $dir . $imgName);

      return $result;
    }
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
  ////// zoek een user
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


  ////// detailpagina van een user

  public function showUser($id)
  {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from users where users.id like '$id'");
    //$statement = $conn->prepare("select * from users, posts where posts.user_id = users.id and users.id like '$id'");
    $statement->execute(array($id));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function showPostsFromUser($id)
  {
    $conn = Db::getInstance();
    $statement = $conn->prepare("select * from users, posts where posts.user_id = users.id and users.id like '$id'");
    $statement->execute(array($id));
    $result = $statement->fetchAll();
    return $result;
  }

  /**
   * Get the value of imgExtenssionError
   */
  public function getImgExtenssionError()
  {
    return $this->imgExtenssionError;
  }

  /**
   * Set the value of imgExtenssionError
   *
   * @return  self
   */
  public function setImgExtenssionError($imgExtenssionError)
  {
    $this->imgExtenssionError = $imgExtenssionError;

    return $this;
  }
}
