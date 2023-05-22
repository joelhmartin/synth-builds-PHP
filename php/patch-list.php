<?php
  // patch-list.php
  
  $patchesDb = new PDO('sqlite:../databases/patches.db');

  $query = $patchesDb->prepare('SELECT * FROM patches');
  $query->execute();
  $patchList = $query->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  print json_encode($patchList);
?>