<?php
require_once('controller/Controlador.php');

class ControladorCambiarTema extends Controlador {

    public function serve() {
        $inserted = updateTema($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']);
        if ($inserted == 1) {
            header('Content-Type: application/json');
            echo '{ "changed" : true }';
        } else {
            http_response_code(400);
        }
    }

}