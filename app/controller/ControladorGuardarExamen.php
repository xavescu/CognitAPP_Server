<?php
require_once('controller/Controlador.php');

class ControladorGuardarExamen extends Controlador {

    public function serve() {
        $doc = insertDocumento($_POST['id'], $_POST['nombre']);
        if (!empty($doc['id'])) {
	        $inserted = insertExamen($doc['id'], $_POST['texto']);
	        if ($inserted == 1) {
	            header('Content-Type: application/json');
	            echo '{ "status" : True }';
	        } else {
	            http_response_code(402);
	            header('Content-Type: application/json');
	            echo '{ "status" : False }';
	        }
	    } else {
	    	deleteDocumento($_POST['nombre'], $_POST['id']);
	    	http_response_code(401);
            header('Content-Type: application/json');
            echo '{ "status" : False }';
	    }
    }

}