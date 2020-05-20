<?php

require_once('controller/Controlador.php');
use thiagoalessio\TesseractOCR\TesseractOCR;

class ControladorCompartir extends Controlador {
	public function serve() {
        try {
            $code = compartir($_POST['id'], $_POST['user']);

            header('Content-Type: application/json');
            $response = array('status' => true, 'code' => $code);
            
            echo json_encode($response, JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo '{"status": false}';
        }
    }
}