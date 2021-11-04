<?php
class Auth{
    // Nombre de la cookie que almacenará la sesión del usuario
    private $cookie_name = '__USER__';

    public function authenticate($user) {
        if (empty($user)) {
            throw new Exception("Fallo de autenticación: usuario vacío");
        }
        // Se crea un objeto de tipo JSON para guardar los datos del usuario como
        // valor de la cookie
        $session = json_encode(
        (object)[
            "id" => $user["id"],
            "username" => $user["username"],
            "token" => $this->getToken($user),
        ]);
        setcookie($this->cookie_name, $session);
    }

    public function logout() {
        unset($_COOKIE[$this->cookie_name]);
        setcookie($this->cookie_name, null, -1);
    }

    public function isAuthenticated($user): bool {
        if (empty($_COOKIE[$this->cookie_name]))
            return false;
        $session = json_decode($_COOKIE[$this->cookie_name], true);
        if ($session["token"] == $this->getToken($user))
            return true;
        return false;
    }

    public function getUser($user) {
        if ($this->isAuthenticated($user))
            return json_decode($_COOKIE[$this->cookie_name], true);
        return null;
    }

    private function getToken($user): string {
        return sha1($user["id"] . $user["username"] . $_SERVER['HTTP_USER_AGENT']);
    }
}
?>
