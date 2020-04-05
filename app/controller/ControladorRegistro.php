<?php

require_once('controller/Controlador.php');

class ControladorRegistro extends Controlador {
	public function serve() {
	    $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(402);
        } else {
            $checkmail = checkEmailExists($email);
            if ($checkmail) {
                http_response_code(400);
            } else {
                $checkuser = checkUserExists($_POST['user']);

                if ($checkuser) {
                    http_response_code(401);
                } else {
                    $inserted = insertUser($email, $_POST['nombre'], $_POST['user'], $_POST['password'], 0);
                    http_response_code(200);
                }
            }
        }
	}
}