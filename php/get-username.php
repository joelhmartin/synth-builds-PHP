<?php
// get-user.php

require_once('User.php');
require_once('functions.php');

use ITS\A\SPACE\User;

session_start();

if (userIsLoggedIn()) {
    $user = User::getUserById($_SESSION['user_uid']);
    $username = $user->getUsername();
} else {
    header('Location: login.php');
    die;
}


$result = htmlentities($username, ENT_QUOTES);

header('Content-Type: application/json');
print json_encode($result);
?>