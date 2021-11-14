<?php
// Se reciben las variables mediante formato POST
$prod = json_decode(file_get_contents('php://input'));

// Se verifica que los campos no vengan vacíos
if (empty((array) $prod))
    die ('Error, campos vacíos');

// Se gestionan los tipos de datos NULLABLES
$img = !empty($prod->image) ? '\'' . $prod->image . '\'' : 'NULL';

// Credenciales de autenticación para la base de datos
// TODO: Cambiarlas una vez que suba el código al 000webhost
$hostname_db = 'localhost';
$user_db = 'kristo';
$passwor_db = '';
$name_db = 'oakmart';
$name_table = 'product';

$conn = mysqli_connect($hostname_db, $user_db, $passwor_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

$query = "INSERT INTO $name_table(name, stock, category, description, price,
         location, image, user_id) VALUES('$prod->name', $prod->stock,
         '$prod->category', '$prod->description', $prod->price,
         '$prod->location', $img, $prod->user_id)";

if (mysqli_query($conn, $query))
    echo '1';
else
    echo '0';
mysqli_close($conn);
?>
