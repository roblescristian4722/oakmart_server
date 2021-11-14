<?php
require('auth.php');
// Recibir variables de una app mediante formato POST
$user = json_decode(file_get_contents('php://input'), true);
$username = $user["username"];
$password = password_hash($user["password"], PASSWORD_DEFAULT);
$email = $user['email'];

if (empty($password) || empty($email)) {
    echo '0';
    die('Datos no válidos');
}

// Credenciales de autenticación para la base de datos
// TODO: Cambiarlas una vez que suba el código al 000webhost
$hostname_db = 'localhost';
$user_db = 'kristo';
$passwor_db = '';
$name_db = 'oakmart';
$name_table = 'user';

// Conexión con la base de datos
$conn = mysqli_connect($hostname_db, $user_db, $passwor_db, $name_db);
if (!$conn)
    die ('Error al conectarse a la base de datos');

// Obtención del usuario
$query = mysqli_query($conn, "SELECT * FROM $name_table WHERE email='$email'");
$password = '';
$data = array();
// Si el correo se encontró
if (mysqli_num_rows($query) == 1) {
    $row = mysqli_fetch_assoc($query);
    $password = $row['password'];
    $data = array(
        'id' => $row['id'],
        'username' => $row['username'],
        'email' => $row['email'],
        'phone' => $row['phone'],
    );
    // Si la contraseña es correcta
    if (password_verify($user['password'], $password)) {
        // Creación de la sesión del usuario
        Auth::authenticate($data);
        echo json_encode($data);
    }
    // Si la contraseña es incorrecta
    else
        echo '0';
// Si el correo no se encontró
} else
    echo '0';
mysqli_close($conn);

$user = array(
    'id' => $data[0]['id'],
    'username' => $data[0]['username']
);
?>
