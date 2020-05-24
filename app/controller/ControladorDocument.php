<?php

require_once('controller/Controlador.php');
use thiagoalessio\TesseractOCR\TesseractOCR;

class ControladorDocument extends Controlador {
    function __construct($code) {
        try {
            $id = getDocId($code);
            //$attachment_location = $_SERVER["DOCUMENT_ROOT"] . "/../pdf/" . $doc . ".pdf";
            /*if(file_exists('/home/pi/pdf/' . $id . '.pdf')) {
                    returnfile('/home/pi/pdf/' . $id . '.pdf', $code);
            } else {*/
                generarfile($id);
                returnfile('/home/pi/pdf/' . $id . '.pdf', $code);
            /*}*/
        } catch (Exception $e) {
            echo '{"status": false}';
        }
    }
	public function serve() {
        
    }
}