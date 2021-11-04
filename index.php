<?php
require("auth.php");
require("login.php");
$auth = new Auth();
$user = json_decode(file_get_contents('php://input'), true);
if ($auth->isAuthenticated($user)) {
    // TODO: main page
} else {
    // TODO: call login
}
?>
