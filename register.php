<?php
// Recibir variables de una app mediante formato POST
$user = json_decode(file_get_contents('php://input'), true);
$username = $user["username"];
$password = password_hash($user["password"], PASSWORD_DEFAULT);

// Credenciales de autenticación para la base de datos
// TODO: Cambiarlas una vez que suba el código al 000webhost
$hostname_db = 'localhost';
$user_db = 'kristo';
$passwor_db = '';
$name_db = 'oakmart';

// Conexión con la BD
$conn = mysqli_connect($hostname, $user_db, $passwor_db, $name_db) OR DIE;
if (!$conn) {
    die ('Error al conectarse a la base de datos');
}

// Inserción del usuario
$query = "INSERT INTO user(username, password) VALUES ('$username', '$password')";
if (mysqli_query($conn, $query)) {
    echo "1";
} else {
    echo "0";
}
mysqli_close($conn);
?>
