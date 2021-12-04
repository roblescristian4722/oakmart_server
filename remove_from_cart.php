<?php
// Se obtiene el nombre de los productos a buscar
if (empty($_GET['cart_id']))
    die ('Error, no se encuentra variable \'cart_id\'');
$id = $_GET['cart_id'];

// Credenciale para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

$query = "DELETE FROM cart WHERE id=$id";

// Retorna el id del producto
$res = mysqli_query($conn, $query);
if (mysqli_affected_rows($conn) > 0)
    echo '1';
else
    echo '0';
mysqli_close($conn);
?>
