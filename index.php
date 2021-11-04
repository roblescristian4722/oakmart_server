<?php
require("auth.php");
$auth = new Auth();
$user = json_decode(file_get_contents('php://input'), true);
$auth->authenticate($user);
// $auth->logout();
echo $auth->isAuthenticated($user) == true ? "auténticado" : "no autenticado";
?>
