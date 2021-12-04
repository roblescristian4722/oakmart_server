<?php
// Se verifica que los campos no vengan vacíos
if (empty($_GET['user_id']))
    die ('Error, no se encuentra user_id');
$id = $_GET['user_id'];

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

$query = "SELECT * FROM purchase WHERE user_id=$id";
$res = mysqli_query($conn, $query);

$data = array();

// Si se encontraron coincidencias
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res))
        $data[] = $row;
    echo json_encode($data);
}
else
    echo '0';
mysqli_close($conn);
?>
