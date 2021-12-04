<?php
// Recibir variables de una app mediante formato POST
$user = json_decode(file_get_contents('php://input'), true);
$username = $user['username'];
$email = $user['email'];
// Variables opcionales
$img = !empty($user['image']) ? '\'' . $user['image'] . '\'' : 'NULL';
$phone = !empty($user['phone']) ? '\'' . $user['phone'] . '\'' : 'NULL';
// Hasheo de contraseña
$password = password_hash($user['password'], PASSWORD_DEFAULT);

// Credenciales de autenticación para la base de datos
$hostname_db = 'localhost';
$user_db = 'id17509552_cristian2';
$password_db = '?DjX_S<l8-Qbtare';
$name_db = 'id17509552_oakmart';
$name_table = 'user';

// Conexión con la BD
$conn = mysqli_connect($hostname_db, $user_db, $password_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

// Inserción del usuario
$query = "INSERT INTO $name_table(username, password, email, phone, image)
          VALUES ('$username', '$password', '$email', $phone, $img)";
if (mysqli_query($conn, $query))
    echo '1';
else
    echo '0';
mysqli_close($conn);
?>
