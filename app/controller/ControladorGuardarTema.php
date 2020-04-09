<?php
require_once('controller/Controlador.php');

class ControladorGuardarTema extends Controlador {

    public function serve() {
        $inserted = insertTema($_POST['nombre'],$_POST['id']);
        if ($inserted == 1) {
            header('Content-Type: application/json');
            echo '{ "status" : true }';
        } else {
            http_response_code(400);
        }
    }

}