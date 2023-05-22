<?php
// User.php
namespace ITS\A\SPACE;

use \PDO;
class User {
    private $uid;
    private $username;
    private $picture;
    private $type;

    private const CONNECTION = 'sqlite:../databases/users.db';

    static function getConnection() {
        return new PDO(User::CONNECTION);
    }

    static function getUserByLoginCredentials($username, $password) {
      $connection = User::getConnection();
      $salted_password = $username . $password . strrev($username);
      $md5_password = md5($salted_password);
      $query = $connection->prepare('SELECT uid, username, password
                                      FROM users
                                      WHERE username = :username
                                      LIMIT 1');
      $query->execute([':username' => $username]);
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if ($result && $result['password'] === $md5_password) {
          return new User($result['uid'], $result['username'], $result['picture'], $result['type']);
      } else {
          return NULL;
      }
  }

    static function getUserById($uid) {
        $connection = User::getConnection();
        $query = $connection->prepare('SELECT uid, username, picture, type FROM users WHERE uid = :uid LIMIT 1');
        $query->bindValue(':uid', $uid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new User($result['uid'], $result['username'], $result['picture'], $result['type']);
        } else {
            return NULL;
        }
    }

    static function usernameIsAvailable($username) {
        $connection = User::getConnection();
        $query = $connection->prepare('SELECT uid FROM users WHERE username = :username LIMIT 1');
        $query->execute([':username' => $username]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return count($result) === 0;
    }

    static function createUser($username, $password, $picture, $type) {
        $connection = User::getConnection();
        $salted_password = $username . $password . strrev($username);
        $md5_password = md5($salted_password);
        $query = $connection->prepare('INSERT INTO users (username, password, picture, type) VALUES (:username, :password, :picture, :type)');
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $md5_password);
        $query->bindParam(':picture', $picture, PDO::PARAM_LOB);
        $query->bindParam(':type', $type);
        $query->execute();
    }
    function __construct($uid, $username, $picture, $type) {
        $this->uid = $uid;
        $this->username = $username;
        $this->picture = $picture;
        $this->type = $type;
    }

    function getId() {
        return $this->uid;
    }

    function getUsername() {
        return $this->username;
    }

    function getPicture() {
      return $this->picture;
    }

    function getType() {
      return $this->type;
    }
}
