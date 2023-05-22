<?php
  // patch-detail.php
  $id = $_GET['id'];
  $patchesDb = new PDO('sqlite:../databases/patches.db');

  $query = $patchesDb->prepare("SELECT * FROM patches WHERE patch_id = :id LIMIT 1");
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $patchDetail = $query->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  print json_encode($patchDetail);
?>