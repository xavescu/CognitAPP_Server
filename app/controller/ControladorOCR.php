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
            echo '{"status": false}';
            http_response_code(400);
        } else {
            echo (new TesseractOCR($_FILES["img"]["tmp_name"]))->run();
        }
    }

    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( $output_file, 'wb' ); 
        fwrite( $ifp, base64_decode($base64_string));
        fclose( $ifp ); 
        
        return $output_file; 
    }

    public function serve64() {
        
        $file = ControladorOCR::base64_to_jpeg($_POST['img'], '/tmp/tmp.jpg');

        echo (new TesseractOCR($file))->run();
    }
}