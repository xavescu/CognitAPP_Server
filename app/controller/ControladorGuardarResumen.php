<?php
require_once('controller/Controlador.php');

class ControladorGuardarResumen extends Controlador {

    public function serve() {
        $doc = insertDocumento($_POST['id'], $_POST['nombre']);
        if (!empty($doc['id'])) {
	        $inserted = insertResumen($doc['id'], $_POST['texto'], $_POST['tipo'], $_POST['foto']);
	        if ($inserted == 1) {
	            header('Content-Type: application/json');
	            echo '{ "status" : true }';
	        } else {
	            http_response_code(402);
	            header('Content-Type: application/json');
	            echo '{ "status" : false }';
	        }
	    } else {
	    	deleteDocumento($_POST['nombre'], $_POST['id']);
	    	http_response_code(401);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
	    }
    }

}