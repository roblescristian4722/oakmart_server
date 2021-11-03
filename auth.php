<?php
class Auth{
    // Nombre de la cookie que almacenará la sesión del usuario
    const COOKIE_NAME = '__USER__';
    // Tiempo en minutos que estará activa la sesión del usuario
    private $time = 30;


    public function authenticate(object $user) {
        if (is_object($user))
            throw new Exception("Fallo de autenticación: no es un objeto");
        else if (empty($user))
            throw new Exception("Fallo de autenticación: usuario vacío");
        // Se crea un objeto de tipo JSON para guardar los datos del usuario como
        // valor de la cookie
        $json_value = json_encode((object)[
            'id' => $user->id,
            'username' => $user->username,
            'token' => $this->genToken($user->id . $user->username),
        ]);
        setcookie($this->COOKIE_NAME, $json_value, time() + (60 * $this->time));
    }

    // Toma una "semilla" como parámetro (id + usuario) y retorna un token
    private function genToken(string $seed): string {
        return sha1((string)rand() . $seed);
    }
}
?>
