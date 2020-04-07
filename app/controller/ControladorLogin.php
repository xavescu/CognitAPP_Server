<?php

require_once('controller/Controlador.php');

class ControladorLogin extends Controlador {
	public function serve() {
		$response = checkCredentialsByUsername($_POST['user'], $_POST['password']);
		if (!$response)
			$response = checkCredentialsByEmail($_POST['user'], $_POST['password']);

		if(!$response) {
			http_response_code(401);
		} else {
			$asignaturas = getAssignaturasByUserId($response['id']);
			$response['asignaturas'] = $asignaturas;

			header('Content-Type: application/json');
			echo json_encode($response, JSON_PRETTY_PRINT);
		}
	}
}