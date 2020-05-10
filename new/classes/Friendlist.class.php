<?php
// FEATURE 9
require_once('User.class.php');


class Friendlist extends User
{
      private $userId;

      //---------Get Friend list
      public function getFriendList()
      {

            //DB CONNECTIE
            $conn = Db::getInstance();

            //QUERY WHERE USER = $_SESSION
            $statement = $conn->prepare("SELECT user1_id, user2_id FROM friend_list WHERE user1_id = :user_id OR user2_id = :user_id");
            $user = $this->getUserId();
            $statement->bindParam(":user_id", $user);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
      }
      //---------Count connections
      public function countConnections()
      {
            //DB CONNECTIE
            $conn = Db::getInstance();

            //QUERY WHERE USER = $_SESSION
            $statement = $conn->prepare("SELECT * FROM friend_list ");
            $statement->execute();
            //$result = $statement->fetch();
            $count = $statement->rowCount();

            return $count;
      }

      public static function getAll()
      {
            $conn = Db::getInstance();

            $statement = $conn->prepare('select user_name from users ');
            $result = $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
      }

      public static function getAllFriends()
      {
            $conn = Db::getInstance();

            $statement = $conn->prepare('SELECT users.first_name, friend_list.user1_id, friend_list.user2_id FROM users INNER JOIN friend_list ON friend_list.user1_id = users.id');

            $result = $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
      }


      //---------Getters & Setters

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
            $this->userId = $userId;

            return $this;
      }
}
