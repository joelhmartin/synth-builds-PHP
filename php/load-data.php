<?php
// load-data.php

$patchesDb = new PDO('sqlite:../databases/patches.db');

$query = $patchesDb->prepare("SELECT * FROM patches");
$query->execute();
$patches = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($patches as &$row) {
  foreach ($row as &$value) {
    if (is_string($value)) {
      $value = htmlentities($value, ENT_QUOTES);
    }
  }
}

header('Content-Type: application/json');
print json_encode($patches);
?>