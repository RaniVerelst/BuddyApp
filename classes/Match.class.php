<?php require_once('EditProfile.class.php');

class Match extends UserDetails {
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
}
?>