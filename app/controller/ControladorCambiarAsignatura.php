<?php
require_once('controller/Controlador.php');

class ControladorCambiarAsignatura extends Controlador {

    public function serve() {
        if(!empty($_POST['nombre'])) {
            if(!existsAsignatura($_POST['id'], $_POST['nombre'])) {
                $err = !updateAsignatura($_POST['id'], $_POST['nombre']);
                if($err) {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo '{ "status" : false }';
                } else {
                    header('Content-Type: application/json');
                    echo '{ "status": true }';
                }
            } else {
                http_response_code(400);
                header('Content-Type: application/json');
                echo '{ "status" : false, "reason": "Ya existe una asignatura con este nombre" }';
            }
        }
    }

}