<?php

require_once('controller/Controlador.php');

class ControladorConsultaUsuario extends Controlador {
    public function serve() {
        $response = checkUserExists($_POST['user']);
        if (!$response)
            $response = checkEmailExists($_POST['user']);

        if(!$response) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
        } else {
            header('Content-Type: application/json');
            $response['status'] = true;
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
}