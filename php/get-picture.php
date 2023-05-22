<?php
// get-user.php
require_once('User.php');
require_once('functions.php');

use ITS\A\SPACE\User;

session_start();

if (userIsLoggedIn()) {
    $user = User::getUserById($_SESSION['user_uid']);
    $picture = $user->getPicture();
    $type = $user->getType();
} else {
    header('Location: login.php');
    die;
}

header("Content-Type: $type");
print $picture
?>