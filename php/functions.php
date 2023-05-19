<?php
// functions.php
function userIsLoggedIn() {
    return isset($_SESSION['user_uid']) && ((int) $_SESSION['user_uid']) > 0;
}

?>