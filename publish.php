<?php
// Se reciben las variables mediante formato POST
$prod = json_decode(file_get_contents('php://input'));

// Se verifica que los campos no vengan vacíos
if (empty((array) $prod))
    die ('Error, campos vacíos');   

// Credenciales de autenticación para la base de datos
// TODO: Cambiarlas una vez que suba el código al 000webhost
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';
$name_table = 'product';

$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

$query = "INSERT INTO $name_table(name, stock, category, description, price,
         location, user_id) VALUES('$prod->name', $prod->stock,
         '$prod->category', '$prod->description', $prod->price,
         '$prod->location', $prod->user_id)";

// Retorna el id del producto
if (mysqli_query($conn, $query)) {
    $res = mysqli_query($conn, "SELECT AUTO_INCREMENT FROM information_schema.TABLES
                        WHERE TABLE_SCHEMA='$name_db' AND TABLE_NAME='$name_table'");
    echo mysqli_fetch_assoc($res)['AUTO_INCREMENT'] - 1;
}
else
    echo '0';
mysqli_close($conn);
?>
