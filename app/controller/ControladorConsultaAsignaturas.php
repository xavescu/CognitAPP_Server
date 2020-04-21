<?php
require_once('controller/Controlador.php');

class ControladorConsultaAsignaturas extends Controlador {

    public function serve() {
    	if($_POST['id']) {
	        $asignaturas['asignaturas'] = getAssignaturasByUserId($_POST['id']);
	        $asignaturas['status'] = true;
	        header('Content-Type: application/json');
	        echo json_encode($asignaturas, JSON_PRETTY_PRINT);
	    } else {
	        header('Content-Type: application/json');
	        echo '{"status": false}';
	    }
    }

}