<?php
$data = json_decode(file_get_contents('php://input'));
if (empty($data->image) || empty($data->product_id))
    die ('Datos no proporcionados');

// Credenciale para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';
$name_table = 'product_img';

$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

$query = "INSERT INTO product_img(product_id, image)
          VALUES($data->product_id, '$data->image')";

if (mysqli_query($conn, $query))
    echo '1';
else
    echo '0';

?>
