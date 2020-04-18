<?php
require_once('controller/Controlador.php');

class ControladorCambiarAsignatura extends Controlador {

    public function serve() {
        $inserted = updateAsignatura($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']);
        if ($inserted == 1) {
            header('Content-Type: application/json');
            echo '{ "status" : True }';
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : False }';
        }
    }

}