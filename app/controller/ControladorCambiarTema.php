<?php
require_once('controller/Controlador.php');

class ControladorCambiarTema extends Controlador {

    public function serve() {
        $changed=false;
        if ($_POST['nuevonombre']) {
            if(!existsTema($_POST['nuevonombre'], $_POST['id'])) {
                $change=updateTemaNombre($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']);
                if ($change==1) {
                    $changed['nombre'] = true;
                }
            } else {
                $change = 0;
                $changed['status'] = false;
                $changed['reason'] = 'Ya existe un tema con ese nombre';
            }
        }
        if ($_POST['nuevaasignatura']) {
            $change = updateTemaSubject($_POST['nuevonombre'],$_POST['id'],$_POST['nuevaasignatura']);
            if ($change==1) {
                $changed['asignatura']=true;
            }
        }
        if ($change) {
            $changed['status'] = true;
        } else {
            http_response_code(400);
        }
        header('Content-Type: application/json');
        echo json_encode($changed, JSON_PRETTY_PRINT);
    }

}