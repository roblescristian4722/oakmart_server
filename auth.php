<?php
class Auth{
    // Nombre de la cookie que almacenará la sesión del usuario
    static private $cookie_name = '__USER__';

    static public function authenticate($user) {
        if (empty($user)) {
            throw new Exception("Fallo de autenticación: usuario vacío");
        }
        // Se crea un objeto de tipo JSON para guardar los datos del usuario como
        // valor de la cookie
        $session = json_encode(
        (object)[
            "id" => $user["id"],
            "username" => $user["username"],
            "token" => self::getToken($user),
        ]);
        setcookie(self::$cookie_name, $session);
    }

    static public function logout() {
        unset($_COOKIE[self::$cookie_name]);
        setcookie(self::$cookie_name, null, -1);
    }

    static public function isAuthenticated($user): bool {
        if (empty($_COOKIE[self::$cookie_name]))
            return false;
        $session = json_decode($_COOKIE[self::$cookie_name], true);
        if ($session["token"] == self::getToken($user))
            return true;
        return false;
    }

    static public function getUser($user) {
        if (self::isAuthenticated($user))
            return json_decode($_COOKIE[self::$cookie_name], true);
        return null;
    }

    static private function getToken($user): string {
        return sha1($user["id"] . $user["username"] . $_SERVER['HTTP_USER_AGENT']);
    }
}
?>
