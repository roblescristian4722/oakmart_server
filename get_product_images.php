<?php
// Se obtiene el nombre de los productos a buscar
$product_id = $_GET['product_id'];
if (empty($product_id))
    die ('Error, la cadena no puede estar vacía');

// Credenciale para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

// Conexión con la base de datos
$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectar con la base de datos');

$query = "SELECT * FROM product_img WHERE product_id=$product_id ORDER BY id ASC";
$data = array();

if ($res = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($res))
        $data[] = $row['image'];
    echo json_encode($data);
}
else
    echo '0';

mysqli_close($conn);
?>
