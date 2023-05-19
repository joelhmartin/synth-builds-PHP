<?php
  // user-list.php
  
  $userDb = new PDO('sqlite:../databases/users.db');

  $query = $userDb->prepare('SELECT * FROM users');
  $query->execute();
  $userList = $query->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  print json_encode($userList);
?>