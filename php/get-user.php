<?php
// get-user.php
require_once('functions.php');

session_start();

if (userIsLoggedIn()) {
    $id = $_SESSION['user_uid'];
} else {
    $id = null;
}

header('Content-Type: application/json');
print json_encode($id);
?>