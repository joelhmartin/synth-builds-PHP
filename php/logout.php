<?php

// logout.php

$_SESSION = [];
setcookie(session_name(), '', time() - 86400, '/');

if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}

header('Location: login.php');
die;
?>
