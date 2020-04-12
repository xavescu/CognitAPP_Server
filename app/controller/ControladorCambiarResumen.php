<?php
require_once('controller/Controlador.php');

class ControladorCambiarResumen extends Controlador {

    public function serve() {
        $inserted = updateResumen($_POST['nombre'],$_POST['id'],$_POST['nuevonombre'], $_POST['nuevotexto'], $_POST['nuevotema']);
        if ($inserted == 1) {
            header('Content-Type: application/json');
            echo '{ "changed" : true }';
        } else {
            http_response_code(400);
        }
    }

}