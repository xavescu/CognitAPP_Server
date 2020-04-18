<?php

require_once('controller/Controlador.php');
use thiagoalessio\TesseractOCR\TesseractOCR;

class ControladorOCR extends Controlador {
	public function serve() {
        $path = '/tmp';
        $target_file = $path . basename($_FILES["img"]['name']);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //echo '<pre>';
        $isuploadOk = in_array($imageFileType, array('png', 'jpg', 'jpeg'));
        if(!$isuploadOk) {
            echo '{"status": False}';
            http_response_code(400);
        } else {
            echo (new TesseractOCR($_FILES["img"]["tmp_name"]))->run();
        }
	}
}