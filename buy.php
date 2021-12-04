<?php
// Recibir variables de una app mediante formato POST
$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$product_id = $data['product_id'];
$order_id = $data['order_id'];

// Credenciales de autenticación para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

// Conexión con la BD
$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

$res = mysqli_query($conn, "SELECT * FROM product WHERE id=$product_id");
$product_row = mysqli_fetch_assoc($res);

$query = "SELECT * FROM cart WHERE id=$order_id";
if ($res = mysqli_query($conn, $query)) {
    $order_row = mysqli_fetch_assoc($res);
    $pieces = $order_row['pieces'];
    $price = $product_row['price'];
    $price_total = $price * $pieces;
    $stock = $product_row['stock'] - $pieces;
    // Realización de la compra
    $query = "INSERT INTO purchase(user_id, product_id, pieces, price, price_total)
              VALUES($user_id, $product_id, $pieces, $price, $price_total)";
    if (mysqli_query($conn, $query) && $order_row['product_id'] == $product_row['id']) {
        mysqli_query($conn, "DELETE FROM cart WHERE id=$order_id");
        mysqli_query($conn, "UPDATE product SET stock=$stock WHERE id=$product_id");
        echo '1';
    }
    else
        echo '0';
}
else
    echo '0';
mysqli_close($conn);
?>
