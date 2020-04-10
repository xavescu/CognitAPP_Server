<?php
require_once('controller/Controlador.php');

class ControladorCambiarUsuario extends Controlador {
    public function serve() {
        $response = checkUserExists($_POST['user']);
        if (!$response) {
            $inserted = updateUser($_POST['id'], $_POST['nuevonombre']);
            if ($inserted == 1) {
                header('Content-Type: application/json');
                echo '{ "changed" : true }';
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(401);
        }
    }
}