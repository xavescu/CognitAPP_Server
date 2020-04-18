<?php
require_once('controller/Controlador.php');

class ControladorBorrarAsignatura extends Controlador {

    public function serve() {
        $deleted = deleteAsignatura($_POST['nombre'],$_POST['id']);
        if ($deleted == 1) {
            header('Content-Type: application/json');
            echo '{ "status" : True }';
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : False }';
        }
    }

}