<?php

require_once('controller/Controlador.php');
use thiagoalessio\TesseractOCR\TesseractOCR;

class ControladorDocument extends Controlador {
    function __construct($code) {
        try {
            //$doc = getDocId($code);
            //$attachment_location = $_SERVER["DOCUMENT_ROOT"] . "/../pdf/" . $doc . ".pdf";
            $attachment_location = '/home/pi/a.pdf';
            if (file_exists($attachment_location)) {

                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public"); // needed for internet explorer
                header("Content-Type: application/zip");
                header("Content-Transfer-Encoding: Binary");
                header("Content-Length:".filesize($attachment_location));
                header("Content-Disposition: attachment; filename=".$code.".pdf");
                readfile($attachment_location);
                die();        
            } else {
                die("Error: File not found.");
            }
        } catch (Exception $e) {
            echo '{"status": false}';
        }
    }
	public function serve() {
        
    }
}