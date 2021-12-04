<?php
if (empty($_GET['user_id']))
    die ('Error, la cadena no puede estar vacía');

// Se obtiene el nombre de los productos a buscar
$user_id = $_GET['user_id'];

// Credenciale para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

// Conexión con la base de datos
$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectar con la base de datos');

$query = "SELECT * FROM cart WHERE user_id=$user_id";
$data = array();

if ($res = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($res))
        $data[] = array('cart_id' => $row['id'],
                        'product_id' => $row['product_id'],
                        'pieces' => $row['pieces']);
    echo json_encode($data);
}
else
    echo '0';

mysqli_close($conn);
?>
