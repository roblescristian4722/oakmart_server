<?php
// Se obtiene el nombre de los productos a buscar
$data = json_decode(file_get_contents('php://input'), true);
if (empty($data['product_id']))
    die('Error product_id empty');
    
$product_id = $data['product_id'];

// Credenciale para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

// Conexión con la base de datos
$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectar con la base de datos');

$data = array();

foreach ($product_id as $i) {
    $query = "SELECT * FROM product WHERE id=$i";
    if ($res = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($res))
            $data[] = $row;
    }
    else {
        echo '0';
        break;
    }
}

echo json_encode($data);

mysqli_close($conn);
?>
