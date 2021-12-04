<?php
if (empty($_GET['product_id']))
    die('Error, no se cuenta con produc_id');
if (empty($_GET['pieces']))
    die('Error, no se cuenta con pieces');
if (empty($_GET['user_id']))
    die('Error, no se cuenta con user_id');

$product_id = $_GET['product_id'];
$pieces = $_GET['pieces'];
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

$query = "SELECT stock FROM product WHERE id=$product_id";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res)) {
    $stock = mysqli_fetch_row($res);
    if ($pieces <= $stock[0]) {
        $query = "INSERT INTO cart(product_id, user_id, pieces) VALUES($product_id, $user_id, $pieces)";
        if (mysqli_query($conn, $query))
            echo '1';
        else
            echo '0';
    } else
        echo '2';
}
else
    echo '0';
    
mysqli_close($conn);
?>
