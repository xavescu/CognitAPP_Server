<?php
require_once('controller/Controlador.php');

class ControladorGuardarResumen extends Controlador {

    public function serve() {
        $doc = insertDocumento($_POST['id'], $_POST['nombre']);
        if (!empty($doc['id'])) {
	        $inserted = insertResumen($doc['id'], $_POST['texto']);
	        if ($inserted == 1) {
	            header('Content-Type: application/json');
	            echo '{ "status" : true }';
	        } else {
	            http_response_code(402);
	        }
	    } else {
	    	deleteDocumento($_POST['nombre'], $_POST['id']);
	    	http_response_code(401);
	    }
    }

}