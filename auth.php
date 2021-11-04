<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Auth{
    // Nombre de la cookie que almacenará la sesión del usuario
    static private $cookie_name = '__USER__';

    static private function petition($query) {
        $hostname_db = 'localhost';
        $user_db = 'kristo';
        $passwor_db = '';
        $name_db = 'oakmart';

        $conn = mysqli_connect($hostname_db, $user_db, $passwor_db, $name_db);
        if (!$conn)
            die ('Error al conectarse a la base de datos');
        $res = mysqli_query($conn, $query);
        mysqli_close($conn);
        return $res;
    }

    static public function authenticate($user) {
        if (empty($user)) {
            throw new Exception("Fallo de autenticación: usuario vacío");
        }
        $token = self::getToken($user);
        $email = $user['email'];
        self::petition("UPDATE user SET token='$token' WHERE email='$email'");
    }

    static public function logout($user) {
        $email = $user["email"];
        self::petition("UPDATE user SET token=NULL WHERE email='$email'");
    }

    static public function isAuthenticated($user): bool {
        $email = $user['email'];
        $res = self::petition("SELECT * from user where email='$email'");
        if (!mysqli_num_rows($res))
            return false;
        $session = mysqli_fetch_assoc($res);
        if (empty($session['token']))
            return false;
        // echo self::getToken($user);
        if ($session['token'] == self::getToken($user))
            return true;
        return false;
    }

    static public function getUser($user) {
        $email = $user['email'];
        if (self::isAuthenticated($user))
            $res = self::petition("SELECT * from user where email='$email'");
            return mysqli_fetch_assoc($res);
        return null;
    }

    static private function getToken($user): string {
        return sha1($user["id"] . $user["username"] . $_SERVER['HTTP_USER_AGENT']);
    }
}
?>
