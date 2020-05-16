<?php
require_once('controller/Controlador.php');

class ControladorGuardarFita extends Controlador {

    public function serve() {
        $inserted = insertFita($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['fecha_limite'], $_POST['tipo_recordatorio']);
        
        if ($inserted == 1) {
            header('Content-Type: application/json');
            echo '{ "status" : true }';
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
        }
    }

}