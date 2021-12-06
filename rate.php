<?php
if (empty($_GET['product_id']))
    die('Error, no se encuentra product_id');
$product_id = $_GET['product_id'];
if (empty($_GET['user_id']))
    die('Error, no se encuentra user_id');
$user_id = $_GET['user_id'];
if (empty($_GET['rating']))
    die('Error, no se encuentra rating');
$commentary = empty($_GET['commentary']) ? null : "'" . $_GET['commentary'] . "'";
$rating = $_GET['rating'];

// Credenciales de autenticación para la base de datos
// TODO: Cambiarlas una vez que suba el código al 000webhost
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';

$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if ($conn)
    die ('Error al conectarse a la base de datos');

$query = "SELECT * FROM rating WHERE user_id = $user_id";
echo $query;
$res = mysqli_query($conn, $query);
if (!empty($res) && mysqli_num_rows($res) > 0) {
    mysqli_query($conn, "DELETE FROM review where user_id = $user_id");
    mysqli_query($conn, "INSERT INTO review(product_id, user_id, rating, commentary) VALUES($product_id, $user_id, $rating, $commentary)");
    echo '1';
} else {
    $query = "INSERT INTO review(product_id, user_id, rating, commentary) VALUES($product_id, $user_id, $rating, $commentary)";
    mysqli_query($conn, $query);
    echo '0';
}
mysqli_close($conn);
?>
