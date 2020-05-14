<?php

require_once('controller/Controlador.php');

class ControladorDesactivarTutorial extends Controlador {
	public function serve() {
		$response = disableTutorial($_POST['id']);

		if(!$response) {
			http_response_code(401);
            header('Content-Type: application/json');
            echo '{ "status" : false }';
		} else {
			$response['status'] = true;
			
			header('Content-Type: application/json');
			echo json_encode($response, JSON_PRETTY_PRINT);
		}
	}
}