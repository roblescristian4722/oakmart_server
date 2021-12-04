<?php
// Credenciale para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

// Conexión con la base de datos
$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectar con la base de datos');

// Obtención de los productos
if (!empty($_GET['search']) && !empty($_GET['order'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM product WHERE name LIKE '%$search%'";
} else
    $query = "SELECT * FROM product";
    
if (!empty($_GET['order'])) {
    $order = $_GET['order'];
    switch($order) {
        case 'lower_price':
            $query = $query . " ORDER BY price ASC";
            break;
        case 'higher_price':
            $query = $query . " ORDER BY price DESC";
            break;
        default:
            $query = $query . " ORDER BY rating DESC";
            break;
    }
}

$res = mysqli_query($conn, $query);
$data = array();

// Si se encontraron coincidencias
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
// Caso contrario
} else
    echo '0';

mysqli_close($conn);
?>
