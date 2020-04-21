<?php
require_once('controller/Controlador.php');

class ControladorBorrarExamen extends Controlador {

    public function serve() {
        $deleted = deleteResumen($_POST['nombre'],$_POST['id']); //deleteResumen tambe serveix per examen
        if ($deleted == 1) {
            header('Content-Type: application/json');
            echo '{ "status" : true }';
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
        }
    }

}