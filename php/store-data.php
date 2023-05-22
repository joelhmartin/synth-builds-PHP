<?php
// store-data.php

require_once('User.php');
require_once('functions.php');

use ITS\A\SPACE\User;

session_start();

if (userIsLoggedIn()) {
  $user = User::getUserById($_SESSION['user_uid']);
} else {
  header('Location: login.php');
  die;
}

$title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$synth = filter_var($_POST['synth'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$genre = filter_var($_POST['genre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$author = $user->getUsername();
$instructions = filter_var($_POST['instructions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$patchesDb = new PDO('sqlite:../databases/patches.db');
  $queryData = 
  [
    ':title' => $title,
    ':synth' => $synth,
    ':genre' => $genre,
    ':author' => $author,
    ':instructions' => $instructions
  ];
  $queryString = "INSERT INTO patches (title, synth, genre, author, instructions) 
                  VALUES (:title, :synth, :genre, :author, :instructions)";
  $query = $patchesDb->prepare($queryString);
  $query->execute($queryData);
?>