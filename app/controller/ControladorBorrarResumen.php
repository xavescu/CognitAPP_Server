<?php
require_once('controller/Controlador.php');

class ControladorBorrarResumen extends Controlador {

    public function serve() {
        $deleted = deleteResumen($_POST['nombre'],$_POST['id']);
        if ($deleted == 1) {
            header('Content-Type: application/json');
            echo '{ "deleted" : true }';
        } else {
            http_response_code(400);
        }
    }

}