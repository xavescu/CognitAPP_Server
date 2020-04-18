<?php
require_once('controller/Controlador.php');

class ControladorGuardarAsignatura extends Controlador {

    public function serve() {
        $inserted = insertAsignatura($_POST['nombre'],$_POST['id']);
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