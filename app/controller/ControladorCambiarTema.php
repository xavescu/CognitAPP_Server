<?php
require_once('controller/Controlador.php');

class ControladorCambiarTema extends Controlador {

    public function serve() {
        $changed=false;
        if ($_POST['nuevonombre']) {
            $change=updateTemaNombre($_POST['nombre'],$_POST['id'],$_POST['nuevonombre']);
            if ($change==1) {
                $changed['nombre'] = true;
            }
        }
        if ($_POST['nuevotexto']) {
            $change=updateTemaSubject($_POST['nombre'],$_POST['id'],$_POST['nuevaasignatura']);
            if ($change==1) {
                $changed['asignatura']=true;
            }
        }
        if ($changed) {
            header('Content-Type: application/json');
            echo json_encode($changed, JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
        }
    }

}