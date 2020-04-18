<?php
require_once('controller/Controlador.php');

class ControladorCambiarUsuario extends Controlador {
    public function serve() {
        $changed=false;
        if ($_POST['nuevousername']) {
            $user = checkUserExists($_POST['nuevousername']);
            if (!$user) {
                $change = updateUserUsername($_POST['id'], $_POST['nuevousername']);
                if ($change == 1) {
                    $changed['username'] = true;
                }
            }
        }
        if ($_POST['nuevoemail']) {
            $mail = checkEmailExists($_POST['nuevoemail']);
            if (!$mail && filter_var($_POST['nuevoemail'], FILTER_VALIDATE_EMAIL)) {
                $change = updateUserEmail( $_POST['id'], $_POST['nuevoemail']);
                if ($change == 1) {
                    $changed['email'] = true;
                }
            }
        }
        if ($_POST['nuevacontraseña']) {
            $change = updateUserPassword($_POST['id'],$_POST['nuevacontraseña']);
            if ($change == 1) {
                $changed['contrasena'] = true;
            }
        }
        if ($_POST['nuevonombre']) {
            $change = updateUserNombre($_POST['id'],$_POST['nuevonombre']);
            if ($change == 1) {
                $changed['nombre'] = true;
            }
        }
        if ($changed) {
            $changed['status'] = true;
            header('Content-Type: application/json');
            echo json_encode($changed, JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
            header('Content-Type: application/json');
            echo '{ "status" : False }';
        }

    }
}