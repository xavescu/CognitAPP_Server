<?php
require_once('controller/Controlador.php');

class ControladorCompletarFita extends Controlador {

    public function serve() {
        $completed = completarFita($_POST['id']);
        
        if($completed) {
	        header('Content-Type: application/json');
	        echo '{"status": true}';
	    } else {
	        header('Content-Type: application/json');
	        echo '{"status": false}';
	    }
    }

}