<?php
require("auth.php");
$user = json_decode(file_get_contents('php://input'), true);
Auth::logout($user);
?>
