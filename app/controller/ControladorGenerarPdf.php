<?php

require_once('controller/Controlador.php');

class ControladorGenerarPdf extends Controlador {

	public function serve() {
        $id = $_POST['id'];
        try {
            if (!empty($id)) {
                if(file_exists('/home/pi/pdf/' . $id . '.pdf')) {
                    returnfile('/home/pi/pdf/' . $id . '.pdf', 'CognitappFile.pdf');
                } else {
                    generarfile($id);
                    returnfile('/home/pi/pdf/' . $id . '.pdf', 'CognitappFile.pdf');
                }
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            echo '{"status": false}';
        }
    }
}