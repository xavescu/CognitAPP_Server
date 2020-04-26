<?php
require_once('controller/Controlador.php');

class ControladorCambiarAsignatura extends Controlador {

    public function serve() {
        if(!existsAsignatura($_POST['nuevonombre'], $_POST['id'])) {
            $inserted = updateAsignatura($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']);
            if ($inserted == 1) {
                header('Content-Type: application/json');
                echo '{ "status" : true }';
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                echo '{ "status" : false }';
            }
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false, "reason": "Ya existe una asignatura con este nombre" }';
        }
    }

}